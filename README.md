# Document2

[![code-style](https://github.com/cable8mm/document2/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/document2/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/document2/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/document2/actions/workflows/run-tests.yml)

The Document2 is to generate Laravel style documents to static website.

We have done our best to create a convenient tool for you all. Take a moment to see how it works.

## Features

- [ ] Generate static website from documentations
- [ ] Versions are supported
- [ ] Templates are supported
- [ ] Publish GitHub Pages with actions
- [ ] Testing available locally
- [ ] Dark theme is supported
- [ ] Search is supported
- [ ] SEO is supported

## Installation

```shell
# composer install cable8mm/document2

git clone https://github.com/cable8mm/document2.git
# Cloning this repository
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
