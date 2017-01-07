#!/bin/sh

./setup_php56.sh
./setup_mysql.sh
./setup_mongo.sh
./setup_composer.sh
./setup_intl.sh

composer create-project --prefer-dist cakephp/app reex
