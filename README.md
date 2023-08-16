# BileMo

Résultat sur codacy : [![Codacy Badge](https://app.codacy.com/project/badge/Grade/29cd0e629f534a31889b00f839c1a9f8)](https://www.codacy.com/gh/MarieClaireE/BileMo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MarieClaireE/BileMo&amp;utm_campaign=Badge_Grade)

# Requirement
 - Symfony 6 
 - PHP 8.1
 - MySQL 8

# Documentation OpenApi 
Ouvrir la documentation en local, avec le dossier `/docs`.

# Diagrammes
Les diagrammes se trouvent dans le dossier `diagramms/`.

# Information sur l'API 
1. Le token d'authentification s'obtient via l'envoi des identifiants sur 
l'URI `/api/login_check`.
2. Le couple email, password pour permettre une première connexion :
> `'username': 'admin@bilemo.com'`
> 
> `'password': 'passwordAdmin'`


# Information docker 
L'API peut fonctionner sous docker. Pour cela, il vous suffit de lancer le docker desktop.
1. Verifier les informations dans le `docker-compose.yml`
2. Mettre à jour les données de la base de données dans le fichier `.env.local`
3. Lancer le docker via `docker compose up`

# Installation du projet 
1. Cloner ou télécharger le projet :
   `git clone https://github.com/MarieClaireE/BileMo.git`
2. Configurez votre `.env` variables d'environnement (base de données...) à partir de `.env.local`.
3. Faites un `composer install`
4. Si vous n'avez pas encore créer votre base de données, après vous 
êtes placé dans le répertoire du projet, faites un `php bin/console doctrine:database:create`.
Ensuite créez les différentes tables du projet en faisant un `php bin/console doctrine:migration:migrate`
5. Une fois la base de données créée lancer `php bin/console doctrine:fixtures:load` pour remplir avec des données la base de données.

6. Générer vos clés pour l'utilisation de JWT Token
   > `$ mkdir -p config/jwt`
   > 
   > `$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`
   > 
   > `$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`

7. Renseigner vos paramètres de configuration dans votre ficher .env
   >`###> lexik/jwt-authentication-bundle ###
    JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
    JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
    JWT_PASSPHRASE=VotrePassePhrase
    ###< lexik/jwt-authentication-bundle ###`
