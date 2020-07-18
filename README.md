# PHPUnit Github Actions

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/c617fe1e515d4c4bbe70102bff614d6a)](https://www.codacy.com/manual/JakobVesely/phpunit-github-actions?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=JakobVesely/phpunit-github-actions&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/c617fe1e515d4c4bbe70102bff614d6a)](https://www.codacy.com/manual/JakobVesely/phpunit-github-actions?utm_source=github.com&utm_medium=referral&utm_content=JakobVesely/phpunit-github-actions&utm_campaign=Badge_Coverage)

Running PHP Unit manually

```sh
./vendor/bin/phpunit tests --testdox
```
with existing `phpunit.xml`
```sh
./vendor/bin/phpunit --testdox
```


## Setup

### PHPUnit Config `/phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8" ?>
<phpunit
    backupGlobals="false"
    backupStaticAttributes="false"
    bootstrap="vendor/autoload.php"
    colors="true"
    convertErrorsToExceptions="true"
    convertNoticesToExceptions="true"
    convertWarningsToExceptions="true"
    processIsolation="false"
    stopOnFailure="false">
    <testsuites>
        <testsuite name="Unit Tests">
            <directory suffix=".php">./tests</directory>
        </testsuite>
    </testsuites>
    <logging>
        <log type="coverage-clover" target="./build/clover.xml"/>
    </logging>
    <filter>
        <whitelist addUncoveredFilesFromWhitelist="true">
            <directory>./src</directory>
        </whitelist>
    </filter>
</phpunit>
````

### CI Pipeline sample `ci.yml`
```yml
name: CI - Unit Tests & Coverage

on:
  push:
    branches: [ master ]
  pull_request:
    branches: [ master ]

jobs:
  tests:
    name: Unit Tests & Coverage

    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v2

    - name: Validate composer.json and composer.lock
      run: composer validate

    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v2
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-
    - name: Install dependencies
      if: steps.composer-cache.outputs.cache-hit != 'true'
      run: |
        composer install --no-suggest --prefer-dist --optimize-autoloader --no-progress
        
    - name: Run Tests
      run: ./vendor/bin/phpunit tests --testdox
      
    - name: Print Clover XML
      run: cat build/clover.xml
    
    - name: Run codacy-coverage-reporter
      uses: codacy/codacy-coverage-reporter-action@master
      with:
        project-token: ${{ secrets.CODACY_CODE_COVERAGE_TOKEN }}
        coverage-reports: build/clover.xml
```