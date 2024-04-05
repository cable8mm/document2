# Document2 - Documentation Generator

[![code-style](https://github.com/cable8mm/document2/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/document2/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/document2/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/document2/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/document2)](https://packagist.org/packages/cable8mm/document2)
[![Packagist Downloads](https://img.shields.io/packagist/dt/cable8mm/document2)](https://packagist.org/packages/cable8mm/document2/stats)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/document2/php)](https://packagist.org/packages/cable8mm/document2)
![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/document2/laravel-zero%2Fframework)
[![Packagist Stars](https://img.shields.io/packagist/stars/cable8mm/document2)](https://github.com/cable8mm/document2/stargazers)
[![Packagist License](https://img.shields.io/packagist/l/cable8mm/document2)](https://github.com/cable8mm/document2/blob/main/LICENSE.md)

The Document2 is to generate Laravel style documents to static website.

We have done our best to create a convenient tool for you all. Take a moment to see how it works.

## Features

- [x] Generate static website from documentations
- [x] Versions are supported
- [x] Templates are supported
- [x] Testing available locally
- [x] Dark theme is supported
- [ ] Publish GitHub Pages with actions
- [ ] Search is supported
- [ ] SEO is supported

## Installation

```shell
composer install cable8mm/document2
```

## Usage

Select your template:

```shell
./document2 template laravel
```

And clone the documentation files:

```shell
bin/checkout_latest_docs.sh
# Import laravel documentations into `docs` folder
```

Finally, run the following command to generate the static htmls

```shell
./document2
# Generate the static html files into the `public` folder

./document2 -d docs -b 7.x -f artisan.md
# Generate the static html file of directory `docs`, branch `7.x` and filename `artisan.md`
```

If Laravel Valet or Laravel Herd has been installed, you can visit https://document2.test.

## Development

### Create Templates

```shell
cd templates

npm run dev
```

and visit http://localhost:5173/. The port can be different.

### Testing

```shell
composer test
```

### Formatting

```shell
composer lint
# Modify all files to comply with the PSR-12.

composer inspect
# Inspect all files to ensure compliance with PSR-12.
```

## License

The Document2 project is open-sourced software licensed under the [MIT license](LICENSE.md).
