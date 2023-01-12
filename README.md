# Time2plug Test technique Tim

## Prérequis

-   php
-   composer
-   docker
-   docker compose

## Installation

-   Run `composer install`
-   Run `php artisan env:decrypt --key {KEY}`
-   Run `php artisan storage:link --relative`

## Lancement du projet

-   Run `./vendor/bin/sail up -d`
-   **Faire la migration de la bdd uniquement la première fois** `./vendor/bin/sail artisan migrate:fresh --seed`
