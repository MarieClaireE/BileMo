# BileMo

Résultat sur codacy : [![Codacy Badge](https://app.codacy.com/project/badge/Grade/29cd0e629f534a31889b00f839c1a9f8)](https://www.codacy.com/gh/MarieClaireE/BileMo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MarieClaireE/BileMo&amp;utm_campaign=Badge_Grade)

# Information sur l'API 
1. Le token d'authentification s'obtient via l'envoi des identifiants sur 
l'URI `/api/login_check`.


# Installation du projet 
1. Cloner ou télécharger le projet :
   `git clone https://github.com/MarieClaireE/BileMo.git`
2. Configurez vos variables d'environnement (base de données...) en racine du projet
dans le fichier `.env.local` qui sera une copie du fichier `.env`.
3. Faites un `composer install`
4. Si vous n'avez pas encore créer votre base de données, après vous 
êtes placé dans le répertoire du projet, faites un `php bin/console doctrine:database:create`.
Ensuite créez les différentes tables du projet en faisant un `php bin/console doctrine:migration:migate`
