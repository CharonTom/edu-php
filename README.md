# La partie Back-office d'edusign

## Installation et Configuration

Suivez ces étapes pour installer et configurer le projet.

Cloner le repo ou télécharger le via le zip

Assurez vous d'avoir Laravel insntallé sur votre machine et faites "composer install" à la racine du projet pour installer les dépendances

Créer un fichier .env à la racine du dossier et entrez-y vos informations pour vous connectez à votre base de données de la même manière que sur le fichier .env.example

taper dans votre terminal "php artisan migrate" puis "php artisan db:seed" pour créer votre base de données.

Lancer l'application avec "php artisan serve"

## API l'appli :

Vous pouvez ensuite tester les routes

http://127.0.0.1:8000/api/login ==> Route pour pouvoir se connecter, retourne un token.

Dans postman, entrer
{
"email": "test@example.com",
"password": "password",
"device_name":"Tom"
}

http://127.0.0.1:8000/generate-qr ==> Route pour générer un QR code (non protégé)

http://localhost:8000/api/signin ==> Notifie l'utilisateur présent, route appeler suite au scannage du QR code. (protégé)

http://localhost:8000/admin/ ==> Route à taper dans un navigateur pour pouvoir accéder au back-office et superviser la classe

Les identifiants sont :

-   test@example.com
-   password": password
