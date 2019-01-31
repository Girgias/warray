[![Build Status](https://travis-ci.org/Girgias/warray.svg?branch=master)](https://travis-ci.org/Girgias/warray)
[![Maintainability](https://api.codeclimate.com/v1/badges/e206471bd6584bce131d/maintainability)](https://codeclimate.com/github/Girgias/warray/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e206471bd6584bce131d/test_coverage)](https://codeclimate.com/github/Girgias/warray/test_coverage)

# Warray a static Wrapper around PHP array functions
A static Wrapper around PHP array functions with consistent signatures and logical
return values.

## Installing

```shell
composer require girgias/warray
```

## Features

Warray provides a clean and consistent interfaces with PHP's array functions.

Most notably making signatures consistent with more sensible default and return values.

For example when a function expects a callback this will ALWAYS be the first argument
in the function signature.

If a function allows a strict comparison argument its default is ``true``
compared to PHP's default of ``false``

If a ``sort_flag`` argument is present its default is ``\SORT_REGULAR``

Sort functions return the sorted array instead of an integer or boolean.

## ToDos

* Complete unit tests

## Contributing

If you'd like to contribute, please fork the repository and use a feature
branch. Pull requests are warmly welcome.

## Links

- Repository: https://github.com/Girgias/warray
- Issue tracker: https://github.com/Girgias/warray/issues
  - In case of sensitive bugs like security vulnerabilities, please contact
    george.banyard@gmail.com directly instead of using the issue tracker.


## Licensing

The code in this project is licensed under MIT license.
