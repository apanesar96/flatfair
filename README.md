# Flatfair Rental System

Flatfair's  rental calculator 

## Getting started


### System requirements and Installation:

- Please ensure you have```php 7.4``` running either on your local machine or homebrew.
- Check PHP version: ``php -v``
- Install Composer (via homebrew): ```brew install composer```
- Run Composer: ``composer install``
- Ensure you are in the repo Directory
## Building
- Run tests in Root Directory of the: ```./vendor/bin/phpunit App/test/```
- Run an instance of the calculation fee in the Root Directory: ```php index.php``` 

## Project Structure

```bash
├── App
│   ├── controller
│   │   └── OrganisationRentalBuild.php
│   ├── futureIterationsAndImprovements
│   │   └── Improvements.txt
│   ├── models
│   │   ├── MembershipCalculator.php
│   │   └── organisation
│   │       ├── Area.php
│   │       ├── Branch.php
│   │       ├── Division.php
│   │       ├── Organisation.php
│   │       └── OrganisationUnitConfig.php
│   └── test
│       └── MembershipCalculatorTest.php
├── README.md
├── composer.json
├── composer.lock
└── index.php
```

## Features
- Running the command: ``php index.php`` will show you an example output of how the rental fee is calculated.
- The directory ```App/models/organisation``` is the company overview model structure. 
- The directory ```App/test``` provides test cases for all the requirements.



