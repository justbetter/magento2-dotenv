# Magento 2 DotEnv loader

Adds support for .env configuration files to Magento 2. Variables in the .env file are used to fill in `app/etc/env.php` variables. This file can be added to source control when using this package. I think having more than one environment file is weird. Besides of that you can lock environment variables in the env.php but it's not really managable via source control.

## Credits
Credits to [this package](https://github.com/Pr00xxy/magento2-dotenv) which inspired me to make this package.

## Installation
- `composer require justbetter/dotenv`
- Copy the `.env.example` [example file](Example/.env.example) to `app/etc/.env` and fill in your environment variables.
- Replace the `env.php` with this [one](Example/env.php) and commit it to source control.
Note: setup:upgrade will add an autoload file to your composer.json root file to autoload the propper environment. You can commit this.
- `bin/magento setup:upgrade`
- run in the root `composer dumpautoload` to autoload the dot env files.

## Extending the environments
You can override specific environments with the APP_ENV variable in the dot env filename. [example](Example/.env.development.example). Copy the file to `app/etc/` and modify for any specified environment.

## Disabled the writer to env.php
Because of the Writer class of magento 2 the `env.php` get rewrited every time. I disabled this functionality because the `env.php` file is not static. The cache types are not reset every time when you run `bin/magento setup:upgrade`.

## Compatibility
The module is tested on Magento version 2.3.x

## Ideas, bugs or suggestions?
Please create a [issue](https://github.com/justbetter/magento2-sentry/issues) or a [pull request](https://github.com/justbetter/magento2-sentry/pulls).

## About us
We’re a innovative development agency from The Netherlands building awesome websites, webshops and web applications with Laravel and Magento. Check out our website [justbetter.nl](https://justbetter.nl) and our [open source projects](https://github.com/justbetter).

## License
[MIT](LICENSE)

---

<a href="https://justbetter.nl" title="JustBetter"><img src="https://raw.githubusercontent.com/justbetter/art/master/justbetter-logo.png" width="200px" alt="JustBetter logo"></a>
