#!/bin/bash

DOCS_VERSIONS=(
  10.x
)

for v in "${DOCS_VERSIONS[@]}"; do
    if [ -d "docs/$v" ]; then
        echo "Pulling latest documentation updates for $v..."
        (cd docs/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" https://github.com/laravel/docs "docs/$v"
    fi;
done
