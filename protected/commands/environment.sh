#!/bin/bash
enviroment='dev'
if [ "$1" = "$enviroment" ]; then
    echo "Changing to development"
    cp ../resourses/main.development.php ../config/main.php
else
    echo "Changing to production"
    cp ../resourses/main.production.php ../config/main.php
fi