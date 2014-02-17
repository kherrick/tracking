#!/bin/bash
CWD="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
echo $CWD

cd $CWD
cd ..

flag=0

if [ -d vendor ]; then
    flag=1
    echo The vendor directory already exists.
fi

if [ -f db.sqlite ]; then
    flag=1
    echo The database file db.sqlite already exists.
fi

if [ $flag -eq 1 ]; then
    echo Please initialize the project only once.
    exit
fi

bin/composer update
bin/composer install
bin/doctrine/init-database.php
