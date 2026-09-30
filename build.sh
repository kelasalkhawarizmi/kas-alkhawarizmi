#!/usr/bin/env bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-interaction