document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France avec un zoom initial plus élevé

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Charger les données GeoJSON des départements français
    fetch('https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/departements.geojson')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors du chargement des données GeoJSON');
            }
            return response.json();
        })
        .then(data => {
            var geojson = L.geoJSON(data, {
                style: function (feature) {
                    return {
                        color: 'blue',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.5
                    };
                },
                onEachFeature: function (feature, layer) {
                    layer.on({
                        mouseover: function (e) {
                            var layer = e.target;
                            layer.setStyle({
                                weight: 3,
                                color: 'yellow',
                                fillOpacity: 0.7
                            });
                            layer.bindPopup(feature.properties.nom, { closeButton: false }).openPopup();
                        },
                        mouseout: function (e) {
                            var layer = e.target;
                            layer.setStyle({
                                weight: 2,
                                color: 'blue',
                                fillOpacity: 0.5
                            });
                            layer.closePopup();
                        },
                        click: function (e) {
                            alert('Vous avez cliqué sur le département : ' + feature.properties.nom);
                        }
                    });
                }
            }).addTo(map);

            // Ajustez les limites après l'ajout des données
            setTimeout(() => {
                map.fitBounds(geojson.getBounds(), { padding: [20, 20] });
                map.setZoom(5);
            }, 500);
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
});

setTimeout(function () {
    var msg = document.getElementById('message');
    if (msg) {
        msg.style.display = 'none';
    }
}, 3000);


document.addEventListener('DOMContentLoaded', function () {
    fetch('/PHP/Stage/src/api/associations.php')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('associations-container');

            // Crée une ligne pour chaque paire de cartes
            let row = document.createElement('div');
            row.classList.add('row', 'justify-content-center', 'mx-0');

            data.forEach((assoc, index) => {
                // Limite la longueur de la description (par exemple à 200 caractères)
                let description = assoc.descriptif;
                const maxLength = 200;
                if (description.length > maxLength) {
                    description = description.substring(0, maxLength) + '...';
                }

                const card = `
                        <div id="card-association" class="card col-10 col-md-6 col-lg-4 col-xl-3 offset-1 offset-md-3 offset-lg-1"">
                            <img src="${assoc.logo}" class="card-img-top" alt="Logo ${assoc.nom}">
                            <div class="card-body">
                                <h5 class="card-title mt-3 mb-3">${assoc.nom}</h5>
                                <p class="card-text">${description}</br></br><a href="${assoc.siteWeb}" target="_blank">Site internet</a></p>
                            </div>
                            <div class="card-main">
                                <div class="row mb-3 mt-3">
                                    <div class="col-3 offset-2">
                                        ${assoc.telegram ? `<a href="${assoc.telegram}" target="_blank"><i class="h2 bi bi-telegram"></i></a>` : ''}
                                    </div>
                                    <div class="col-3">
                                        ${assoc.facebook ? `<a href="${assoc.facebook}" target="_blank"><i class="h2 bi bi-facebook"></i></a>` : ''}
                                    </div>
                                    <div class="col-3">
                                        ${assoc.instagram ? `<a href="${assoc.instagram}" target="_blank"><i class="h2 col-4 bi bi-instagram"></i></a>` : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="${assoc.siteWeb}" class="btn btn-primary">S'abonner</a>
                                <br>
                                <small class="text-muted">Dernière mise à jour il y a 3 jours</small>
                            </div>
                        </div>
                    `;

                row.innerHTML += card;

                // Après avoir ajouté 2 cartes, ajoutez la ligne au conteneur et créez une nouvelle ligne
                if ((index + 1) % 2 === 0 || index === data.length - 1) {
                    container.appendChild(row);
                    row = document.createElement('div'); // Crée une nouvelle ligne pour les prochaines cartes
                    row.classList.add('row', 'justify-content-center', 'mx-0');
                }
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des associations:', error));
});



document.addEventListener('DOMContentLoaded', function () {
    // URL de l'API - Assurez-vous que ce chemin est correct
    const apiUrl = 'http://localhost/PHP/Stage/src/api/evenements.php';

    // Fonction pour limiter la description
    function limitDescription(text, maxLength = 150) {
        if (!text) return 'Aucune description disponible';
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength).trim() + '...voir plus';
    }

    // Fonction pour charger les événements
    function chargerEvenements() {
        // Sélectionner le conteneur où afficher les événements
        const container = document.getElementById('evenements-container');

        // Message de chargement
        container.innerHTML = '<p>Chargement des événements...</p>';

        // Appel à l'API
        fetch(apiUrl)
            .then(response => {
                // Vérifier si la réponse est OK
                if (!response.ok) {
                    throw new Error('Erreur réseau: ' + response.status);
                }
                return response.json();
            })
            .then(evenements => {
                // Si on a reçu une erreur de l'API
                if (evenements.error) {
                    throw new Error(evenements.error);
                }

                // Vérifier si on a reçu des événements
                if (!evenements || evenements.length === 0) {
                    container.innerHTML = '<p>Aucun événement disponible pour le moment.</p>';
                    return;
                }

                // Vider le conteneur
                container.innerHTML = '';

                // Créer une div de conteneur pour le centrage
                const containerDiv = document.createElement('div');
                containerDiv.className = 'events-wrapper position-relative';
                container.appendChild(containerDiv);

                // Créer une rangée pour contenir les cartes, centrer le contenu
                const rowDiv = document.createElement('div');
                rowDiv.className = 'row justify-content-center';
                containerDiv.appendChild(rowDiv);

                // Créer un élément pour chaque événement
                evenements.forEach(evt => {
                    // Formater la date si elle existe
                    let dateFormatee = '';
                    if (evt.date) {
                        const dateObj = new Date(evt.date);
                        dateFormatee = dateObj.toLocaleDateString('fr-FR', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    }

                    // Récupérer la description et la limiter
                    const description = evt.descriptif || evt.description || 'Aucune description disponible';
                    const limitedDescription = limitDescription(description);

                    // Créer la carte de l'événement
                    const eventCard = document.createElement('div');
                    // Classes responsives pour les différentes tailles d'écran
                    eventCard.className = 'col-10 col-sm-8 col-md-6 col-lg-4 mb-4 event-card-wrapper';

                    eventCard.innerHTML = `
                        <div class="event-card shadow rounded h-100">
                            <a class="event-link text-decoration-none" href="/PHP/Stage/src/pages/evenement.php?id=${evt.id}">
                                <div class="event-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center p-3 bg-light">
                                    <div class="event-date mb-2 mb-sm-0">
                                        <p class="mb-0"><strong>${dateFormatee || 'Date inconnue'}</strong></p>
                                    </div>
                                    <div class="event-location">
                                        <p class="mb-0"><strong>${evt.ville_nom || 'Ville inconnue'}</strong></p>
                                    </div>
                                </div>
                                
                                <div class="event-content p-3">
                                    <div class="event-image-container mb-3">
                                        <img class="event-image img-fluid rounded w-100" src="${evt.chemin || 'placeholder.jpg'}" alt="${evt.titre || 'Événement'}">
                                    </div>
                                    <h3 class="event-title h5 mb-2">${evt.titre || 'Sans titre'}</h3>
                                    <p class="event-description text-muted small">
                                        ${limitedDescription}
                                    </p>
                                </div>
                            </a>
                        </div>
                    `;

                    // Ajouter la carte à la rangée
                    rowDiv.appendChild(eventCard);
                });
            })
            .catch(error => {
                // Afficher l'erreur
                console.error('Erreur:', error);
                container.innerHTML = `
                    <div class="error-message">
                        <p>Impossible de charger les événements.</p>
                        <p>Erreur: ${error.message}</p>
                    </div>
                `;
            });
    }

    // Lancer le chargement des événements
    chargerEvenements();
});



document.getElementById('nbAccompagne')?.addEventListener('input', function () {
    const container = document.getElementById('accompagnants-container');
    container.innerHTML = ''; // Toujours vider d'abord

    const nombre = parseInt(this.value);
    if (isNaN(nombre) || nombre < 0) return; // Laisse 0 passer pour vider le conteneur

    for (let i = 0; i < nombre; i++) {
        let className = "form-group col-10 col-lg-5 col-xxl-4 offset-1";
        if (i % 2 === 1) className += " offset-xxl-2";

        const col = document.createElement('div');
        col.className = className;

        col.innerHTML = `
            <label for="nomAccompagne${i + 1}">Nom de la personne ${i + 1}</label>
            <input type="text" class="form-control mb-3" id="nomAccompagne${i + 1}" name="nomAccompagne${i + 1}" required>

            <label for="prenomAccompagne${i + 1}">Prénom</label>
            <input type="text" class="form-control mb-3" id="prenomAccompagne${i + 1}" name="prenomAccompagne${i + 1}" required>

            <label for="anneeAccompagne${i + 1}">Année de naissance</label>
            <input type="number" class="form-control mb-3" id="anneeAccompagne${i + 1}" name="anneeAccompagne${i + 1}" min="1900" max="${new Date().getFullYear()}" required>
        `;

        container.appendChild(col);
    }
});

// Écoute l'événement de soumission du formulaire Users
document.getElementById("userForm")?.addEventListener("submit", function (event) {
    // Empêche l'envoi automatique du formulaire pour effectuer une validation manuelle
    event.preventDefault();

    let isValid = true; // Indicateur de validité du formulaire

    // Réinitialise tous les messages d'erreur à chaque soumission
    const errorMessages = document.querySelectorAll(".text-danger");
    errorMessages.forEach(message => message.textContent = "");

    // Validation du champ "Nom"
    const nom = document.getElementById("user_nom");
    if (nom.value.trim() === "") {
        document.getElementById("nomError").textContent = "Le nom est obligatoire.";
        isValid = false;
    }

    // Validation du champ "Prénom"
    const prenom = document.getElementById("user_prenom");
    if (prenom.value.trim() === "") {
        document.getElementById("prenomError").textContent = "Le prénom est obligatoire.";
        isValid = false;
    }

    // Validation de l'adresse email avec expression régulière
    const email = document.getElementById("user_email");
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email.value.trim())) {
        document.getElementById("emailError").textContent = "Veuillez entrer une adresse e-mail valide.";
        isValid = false;
    }

    // Validation du téléphone (10 chiffres)
    const telephone = document.getElementById("user_telephone");
    const telRegex = /^(?:\+33|0)[1-9](?:[ \.-]?[0-9]{2}){4}$/;
    if (!telRegex.test(telephone.value.trim())) {
        document.getElementById("telephoneError").textContent = "Veuillez entrer un numéro de téléphone valide (10 chiffres).";
        isValid = false;
    }

    // Validation de l'année de naissance
    const naissance = document.getElementById("user_naissance");
    const currentYear = new Date().getFullYear();
    if (naissance.value.trim() === "" || naissance.value < 1900 || naissance.value > currentYear) {
        document.getElementById("naissanceError").textContent = "Veuillez entrer une année de naissance valide.";
        isValid = false;
    }

    // Validation de l'année d'arrivée en France
    const anneeFrance = document.getElementById("user_arriver_france");
    if (anneeFrance.value.trim() === "" || anneeFrance.value < 1900 || anneeFrance.value > currentYear) {
        document.getElementById("anneeFranceError").textContent = "Veuillez entrer une année d'arrivée valide.";
        isValid = false;
    }

    // Validation de la ville en France
    const villeFrance = document.getElementById("villeFrance");
    if (villeFrance.value.trim() === "") {
        document.getElementById("villeFranceError").textContent = "La ville en France est obligatoire.";
        isValid = false;
    }

    // Validation de la ville en Ukraine
    const villeUkraine = document.getElementById("user_ville_ukraine");
    if (villeUkraine.value.trim() === "") {
        document.getElementById("villeUkraineError").textContent = "La ville en Ukraine est obligatoire.";
        isValid = false;
    }

    // Validation du niveau de langue française
    const niveauLangue = document.getElementById("user_langue_francaise");
    if (niveauLangue.value.trim() === "") {
        document.getElementById("niveauLangueError").textContent = "Le niveau de langue française est obligatoire.";
        isValid = false;
    }

    // Validation du niveau d'étude
    const niveauEtude = document.getElementById("user_niveau_etude");
    if (niveauEtude.value.trim() === "") {
        document.getElementById("niveauEtudeError").textContent = "Le niveau d'étude est obligatoire.";
        isValid = false;
    }

    // Validation du dernier poste occupé en Ukraine
    const dernierPosteUkraine = document.getElementById("user_dernier_poste_ukraine");
    if (dernierPosteUkraine.value.trim() === "") {
        document.getElementById("dernierPosteUkraineError").textContent = "Le dernier poste occupé en Ukraine est obligatoire.";
        isValid = false;
    }

    // Validation du dernier poste occupé en France
    const dernierPosteFrance = document.getElementById("user_dernier_poste_france");
    if (dernierPosteFrance.value.trim() === "") {
        document.getElementById("dernierPosteFranceError").textContent = "Le dernier poste occupé en France est obligatoire.";
        isValid = false;
    }

    // Validation de l'expérience
    const experience = document.getElementById("user_experience");
    if (experience.value.trim() === "") {
        document.getElementById("experienceError").textContent = "L'expérience est obligatoire.";
        isValid = false;
    }

    // Validation du pseudonyme
    const pseudo = document.getElementById("user_pseudonyme");
    if (pseudo.value.trim() === "") {
        document.getElementById("pseudoError").textContent = "Le pseudonyme est obligatoire.";
        isValid = false;
    }

    // Validation du mot de passe
    const userMp = document.getElementById("user_mp");
    if (userMp.value.trim() === "") {
        document.getElementById("userMpError").textContent = "Le mot de passe est obligatoire.";
        isValid = false;
    }

    // Validation de la confirmation du mot de passe
    const userMpConfirm = document.getElementById("user_mp_confirm");
    if (userMpConfirm.value.trim() === "" || userMpConfirm.value !== userMp.value) {
        document.getElementById("userMpConfirmError").textContent = "Les mots de passe ne correspondent pas.";
        isValid = false;
    }

    // Validation du nombre d'accompagnants
    const nbAccompagne = document.getElementById("nbAccompagne");
    if (nbAccompagne.value.trim() !== "" && (nbAccompagne.value < 1 || nbAccompagne.value > 20)) {
        document.getElementById("nbAccompagneError").textContent = "Le nombre d'accompagnants doit être compris entre 1 et 20.";
        isValid = false;
    }

    // Validation des accompagnants si présents
    const accompagnantsContainer = document.getElementById("accompagnants-container");
    const nbAccompagnants = parseInt(nbAccompagne.value, 10);
    if (nbAccompagnants > 0) {
        // Vérifie que les noms et prénoms des accompagnants sont remplis
        for (let i = 0; i < nbAccompagnants; i++) {
            const nomAccompagnant = document.getElementById(`accompagnantNom${i}`);
            const prenomAccompagnant = document.getElementById(`accompagnantPrenom${i}`);
            if (nomAccompagnant && prenomAccompagnant) {
                if (nomAccompagnant.value.trim() === "" || prenomAccompagnant.value.trim() === "") {
                    document.getElementById(`accompagnantNomError${i}`).textContent = "Le nom et prénom de chaque accompagnant sont obligatoires.";
                    isValid = false;
                }
            }
        }
    }

    // Si toutes les validations sont passées, soumettre le formulaire
    if (isValid) {
        this.submit();
    }
});

// Écoute l'événement de soumission du formulaire Associations
document.getElementById("associationForm")?.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;

    // Helper function to set error message
    const setErrorMessage = (elementId, message) => {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
        }
    };

    // Clear previous error messages
    const errorMessages = document.querySelectorAll(".text-danger");
    errorMessages.forEach(message => message.textContent = "");

    // Validate association name
    const nomAssociation = document.getElementById('association_nom');
    if (nomAssociation.value.trim() === '') {
        setErrorMessage('nomAssociationError', 'Le nom de l\'association est requis.');
        isValid = false;
    }

    // Validate president name
    const nomPresident = document.getElementById('association_president');
    if (nomPresident.value.trim() === '') {
        setErrorMessage('nomPresidentError', 'Le nom du président est requis.');
        isValid = false;
    }

    // Validate email
    const email = document.getElementById('association_email');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        setErrorMessage('adresseEmailError', 'Adresse e-mail invalide.');
        isValid = false;
    }

    // Validate city
    const ville = document.getElementById('villeFrance');
    if (ville.value.trim() === '') {
        setErrorMessage('villeFranceError', 'La ville est requise.');
        isValid = false;
    }

    // Validate SIRET number
    const siret = document.getElementById('association_siret');
    if (!/^\d{14}$/.test(siret.value.trim())) {
        setErrorMessage('numeroSiretError', 'Le numéro SIRET doit contenir 14 chiffres.');
        isValid = false;
    }

    // Validate phone number
    const telephone = document.getElementById('association_telephone');
    if (!/^0[1-9]\d{8}$/.test(telephone.value.trim())) {
        setErrorMessage('telephoneError', 'Numéro de téléphone invalide.');
        isValid = false;
    }

    // Valider l'URL Instagram
    const instagram = document.getElementById('association_instagram');
    const instagramUrl = instagram.value.trim();
    const instagramRegex = /^(https?:\/\/)?(www\.)?instagram\.com\/[A-Za-z0-9._%-]+\/?$/;

    if (instagramUrl !== '' && !instagramRegex.test(instagramUrl)) {
        console.log('Invalid Instagram URL:', instagramUrl);
        setErrorMessage('instagramError', 'URL Instagram invalide (ex: https://www.instagram.com/nom_utilisateur).');
        isValid = false;
    }

    // Valider l'URL Facebook
    const facebook = document.getElementById('association_facebook');
    const facebookUrl = facebook.value.trim();
    const facebookRegex = /^(https?:\/\/)?(www\.)?facebook\.com\/[A-Za-z0-9._%-]+\/?$/;

    if (facebookUrl !== '' && !facebookRegex.test(facebookUrl)) {
        console.log('Invalid Facebook URL:', facebookUrl);
        setErrorMessage('facebookError', 'URL Facebook invalide (ex: https://www.facebook.com/nom_utilisateur).');
        isValid = false;
    }

    // Valider l'URL Telegram
    const telegram = document.getElementById('association_telegram');
    const telegramUrl = telegram.value.trim();
    const telegramRegex = /^(https?:\/\/)?(t\.me|telegram\.me)\/[A-Za-z0-9_]+\/?$/;

    if (telegramUrl !== '' && !telegramRegex.test(telegramUrl)) {
        console.log('Invalid Telegram URL:', telegramUrl);
        setErrorMessage('telegramError', 'URL Telegram invalide (ex: https://t.me/nom_utilisateur).');
        isValid = false;
    }

    // Valider l'URL du site web (générique)
    const siteWeb = document.getElementById('association_site_web');
    const siteWebUrl = siteWeb.value.trim();
    const urlRegex = /^(https?:\/\/)?([\w\-]+\.)+[\w\-]{2,}(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/i;

    if (siteWebUrl !== '' && !urlRegex.test(siteWebUrl)) {
        console.log('Invalid website URL:', siteWebUrl);
        setErrorMessage('siteWebError', 'URL de site web invalide.');
        isValid = false;
    }

    // Validate logo
    const logo = document.getElementById('association_logo');
    if (logo.files.length === 0) {
        setErrorMessage('associationLogoError', 'Le logo est requis.');
        isValid = false;
    } else {
        const file = logo.files[0];
        const validExtensions = ['image/jpeg', 'image/png', 'image/gif'];
        if (!validExtensions.includes(file.type)) {
            setErrorMessage('associationLogoError', 'Le fichier doit être une image (JPEG, PNG, GIF).');
            isValid = false;
        }
    }

    // Validate photos
    const photos = document.getElementById('association_photo');
    if (photos.files.length === 0) {
        setErrorMessage('associationPhotoError', 'Au moins une photo est requise.');
        isValid = false;
    } else if (photos.files.length > 3) {
        setErrorMessage('associationPhotoError', 'Vous pouvez télécharger jusqu\'à 3 photos maximum.');
        isValid = false;
    } else {
        for (let i = 0; i < photos.files.length; i++) {
            const file = photos.files[i];
            const validExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/gif'];
            if (!validExtensions.includes(file.type)) {
                setErrorMessage('associationPhotoError', 'Tous les fichiers doivent être des images (JPEG, PNG, GIF).');
                isValid = false;
                break;
            }
        }
    }

    // Validate description
    const description = document.getElementById('association_description');
    if (description.value.trim().length < 20) {
        setErrorMessage('descriptionError', 'La description doit faire au moins 20 caractères.');
        isValid = false;
    }

    // Validate password
    const password = document.getElementById('association_mp');
    const passwordConfirm = document.getElementById('association_mp_confirm');
    if (password.value.length < 12) {
        setErrorMessage('associationMpError', 'Le mot de passe doit contenir au moins 12 caractères.');
        isValid = false;
    }
    if (password.value !== passwordConfirm.value) {
        setErrorMessage('associationMpConfirmError', 'Les mots de passe ne correspondent pas.');
        isValid = false;
    }

    if (isValid) {
        this.submit();
    }
});



