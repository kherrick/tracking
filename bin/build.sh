#!/bin/bash
CWD="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
echo $CWD

cd $CWD
cd ..
bin/composer update
bin/composer install