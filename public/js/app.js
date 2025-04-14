document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([46.603354, 1.888334], 6); // Coordonnées de la France

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Charger les données GeoJSON des départements français
    fetch('https://raw.githubusercontent.com/gregoiredavid/france-geojson/master/departements.geojson')
        .then(response => response.json())
        .then(data => {
            var geojson = L.geoJSON(data, {
                style: function(feature) {
                    return {
                        color: 'blue',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.5
                    };
                },
                onEachFeature: function(feature, layer) {
                    layer.on({
                        mouseover: function(e) {
                            var layer = e.target;
                            layer.setStyle({
                                weight: 3,
                                color: 'yellow',
                                fillOpacity: 0.7
                            });
                            layer.bindPopup(feature.properties.nom, { closeButton: false }).openPopup();
                        },
                        mouseout: function(e) {
                            var layer = e.target;
                            layer.setStyle({
                                weight: 2,
                                color: 'blue',
                                fillOpacity: 0.5
                            });
                            layer.closePopup();
                        },
                        click: function(e) {
                            alert('Vous avez cliqué sur le département : ' + feature.properties.nom);
                        }
                    });
                }
            }).addTo(map);

            // Définir les limites de la carte pour afficher uniquement la France
            map.fitBounds(geojson.getBounds());
        });
});

