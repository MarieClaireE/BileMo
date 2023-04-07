# BileMo

Résultat sur codacy : [![Codacy Badge](https://app.codacy.com/project/badge/Grade/29cd0e629f534a31889b00f839c1a9f8)](https://www.codacy.com/gh/MarieClaireE/BileMo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MarieClaireE/BileMo&amp;utm_campaign=Badge_Grade)

# Resquirement
 - Symfony 6 
 - PHP 8.1
 - MySQL 8

# Documentation OpenApi 
Ouvrir la documentation en local, avec le dossier `/docs`.

# Information sur l'API 
1. Le token d'authentification s'obtient via l'envoi des identifiants sur 
l'URI `/api/login_check`.


# Installation du projet 
1. Cloner ou télécharger le projet :
   `git clone https://github.com/MarieClaireE/BileMo.git`
2. Configurez votre `.env` variables d'environnement (base de données...) à partir de `.env.local`.
3. Faites un `composer install`
4. Si vous n'avez pas encore créer votre base de données, après vous 
êtes placé dans le répertoire du projet, faites un `php bin/console doctrine:database:create`.
Ensuite créez les différentes tables du projet en faisant un `php bin/console doctrine:migration:migate`
