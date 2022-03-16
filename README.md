# LEDOC API - Symfony
**© Manon DELEEST - Benjamin PELAUDEIX - Valentin ROUGIER - Florian TORIBIO**

[![Langage](https://skillicons.dev/icons?i=php)](https://skillicons.dev)

## Installation du projet
### Récuperation du projet
Le projet est téléchargeable en HTTPS ou en SSH via ces commandes : 

`HTTPS : git clone https://github.com/Benjamin-Pelaudeix/LeDoc-Api.git`

`SSH : git clone git@github.com:Benjamin-Pelaudeix/LeDoc-Api.git`

### Installation des dépendances
Les dépendances du projet symfony sont stockées dans un dossier **vendor**. Ce dossier représente la majeur partie du poids de l'application, il faut donc éviter de le versionner. Pour installer les dépendances: 

`cd ledocapi`

`composer install`

### Mise en place de la base de données
Le CLI Symfony permet en une commande d'importer la configuration de la base de données : 

`php bin/console doctrine:migrations:migrate`

Pour fluidifier l'utilisation de l'application, des données fictives créées grâce au composant Faker sont disponibles.

`php bin/console doctrine:fixtures:load`

La base de données possède maintenant un schéma à jour avec des données.

## Documentation de l'API
La documentation de l'API est disponible au lien suivant : https://localhost:8000/api.
