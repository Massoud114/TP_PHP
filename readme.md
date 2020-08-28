TP CRUD PHP
==============

Simple application back-office de gestion d'un Musée

Requirements
------------

  * PHP 7.2.9 ou plus;
  * [Usual Symfony application requirements][1].

Comment installer le projet
---------------------------

  1. `git clone https://github.com/Massoud114/TP_PHP`
  1. `cd TP_PHP/`
  1. `composer install`
  1. `symfony server:start`
  1. Aller sur `http://127.0.0.1:8000/`

Ensuite, créer la base de donnée:

  1. Modifier la variable env `DATABASE_URL` dans le fichier `.env` .
  1. `php bin/console doctrine:database:create`
  1. `php bin/console doctrine:schema:create`
  1. `php bin/console doctrine:fixtures:load` pour charger les données dans la base de données

Le projet est amélioré en utilisant le Bundle [EasyAdmin][2].

Allez sur `http://127.0.0.1:8000/admin` pour avoir un aperçu

[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://github.com/EasyCorp/EasyAdminBundle
