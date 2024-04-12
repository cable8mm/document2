#!/bin/bash

echo "Installing theme from $1"

if [[ $# -eq 0 ]] ; then
    echo No arguments were provided.
    exit 1
fi

url=$1

theme=${url##*/}
theme=${theme/-theme}

cd templates

echo "Cloning theme"

git clone --single-branch $url.git $theme

cd $theme

echo "Run npm install"

npm install

echo "Run npm run build"

npm run build

cd ../../

./document2 template $theme

echo "Completed building $theme theme"
