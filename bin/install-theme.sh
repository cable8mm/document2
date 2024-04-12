#!/bin/bash

echo "Installing theme from $1"

if [[ $# -eq 0 ]] ; then
    echo No arguments were provided.
    exit 1
fi

url=$1

theme=${url##*/}

cd templates

echo "Cloning theme"

git clone --single-branch $url.git

cd $theme

echo "Run npm install"

npm install

echo "Run npm run build"

npm run build

cd ../../

./document2 template laravel

echo "Completed building $theme theme"
