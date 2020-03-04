#!/bin/bash

echo "Installing dependencies ..."
composer install

echo "Generating .env file ..."
cp .env.example .env

echo "Generating key ..."
php artisan key:generate
