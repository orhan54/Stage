
# 🇺🇦 Projet Web - Ukraine En France

Ce site a pour but de centraliser les démarches d’accueil pour les réfugiés ukrainiens en France : hébergements, événements, associations, emplois, formations et accompagnements.

---

## 🚀 Mise en route en local (environnement de développement)

Suivez ces étapes pour exécuter le projet sur votre machine locale avec **XAMPP**, **Composer** et **VS Code**.

---

### 📥 1. Cloner le projet depuis GitHub

```bash
git clone https://github.com/<ton-utilisateur>/<ton-projet>.git
```

Remplace `<ton-utilisateur>/<ton-projet>` par l'URL réelle de ton dépôt GitHub.

---

### 📁 2. Déplacer le projet dans `htdocs` de XAMPP

Copiez ou déplacez le dossier cloné dans le répertoire suivant :

```
C:\xampp\htdocs\
```

---

### ⚙️ 3. Installer Composer (si ce n’est pas déjà fait)

Téléchargez l’installateur depuis :  
👉 https://getcomposer.org/

Vérifiez l’installation :

```bash
composer --version
```

---

### 💻 4. Ouvrir le projet dans VS Code et installer les dépendances

Depuis VS Code ou un terminal :

```bash
cd C:\xampp\htdocs\<ton-projet>
composer require vlucas/phpdotenv
```

Cela installera la bibliothèque `vlucas/phpdotenv` pour gérer les variables d’environnement.

---

### 🔐 5. Vérifier la présence du fichier `.env`

Assurez-vous que le fichier `.env` se trouve bien à la racine du projet. Exemple de contenu :

```env
DB_HOST=localhost
DB_NAME=ukraine
DB_USER=root
DB_PASSWORD=
```

> Ce fichier configure l’accès à la base de données.  
> Ne jamais le publier sur GitHub !

---

### 🗄 6. Créer la base de données et importer les fichiers SQL

1. Lancer XAMPP, démarrer **Apache** et **MySQL**
2. Accéder à [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
3. Créer une base nommée **ukraine**
4. Importer successivement ces fichiers SQL (dans cet ordre) :
   - `ukraine.sql` (structure complète des tables)
   - `departement.sql` (tous les départements français)
   - `villeFR.sql` (les villes françaises)

---

### 👤 7. Insérer des types d’utilisateur

Dans `phpMyAdmin`, exécuter cette requête SQL dans la base `ukraine` :

```sql
INSERT INTO TypeUser (type_nom) VALUES ('user'), ('admin');
```

---

### 🖼️ 8. Insérer des types de médias

Toujours dans la base `ukraine`, exécutez :

```sql
INSERT INTO TypeMedia (type_nom) VALUES ('photo'), ('video');
```

---

### ✅ 9. Lancer le projet dans un navigateur

Allez à l’adresse suivante :

```
http://localhost/<ton-projet>/public/
```

Remplace `<ton-projet>` par le nom réel du dossier du projet placé dans `htdocs`.

---

## 📁 Arborescence du projet (exemple)

```
ukraine-projet/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── config/
│   └── database.php
├── public/
│   └── index.php
├── .env
├── composer.json
├── README.md
```

---

## 🛡️ Conseils

- Activez les erreurs PHP pendant le développement (`display_errors = On`)
- Protégez le dossier `config` en production
- Vérifiez les accès aux rôles selon les types d’utilisateurs (`TypeUser`)

---

## 🧑‍💻 Auteur & Contributions

Développé dans le cadre d’un projet d’intégration pour les réfugiés ukrainiens.  
N’hésitez pas à ouvrir une **issue** ou une **pull request** sur le dépôt GitHub.

---

## 📝 Licence

Ce projet est open-source — vous pouvez le modifier librement.
