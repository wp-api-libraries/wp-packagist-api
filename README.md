# WP Packagist API

[![Code Climate](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api/badges/gpa.svg)](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api)
[![Test Coverage](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api/badges/coverage.svg)](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api/coverage)
[![Issue Count](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api/badges/issue_count.svg)](https://codeclimate.com/github/wp-api-libraries/wp-packagist-api)
[![Build Status](https://travis-ci.org/wp-api-libraries/wp-packagist-api.svg?branch=master)](https://travis-ci.org/wp-api-libraries/wp-packagist-api)

A WordPress library for [Packagist API](https://packagist.org/apidoc)

## Example Usage

#### Get All Packages
```php
$packagist = new PackagistAPI();

$results = $packagist->get_all_packages();
```