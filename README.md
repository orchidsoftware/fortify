# Orchid template for Fortify

## Introduction

Authentication scaffolding with Bootstrap 4. 

### Installation

You have to install [Laravel Fortify](https://github.com/laravel/fortify), and complete all setup without add blades calling in `App\Providers\FortifyServiceProvider.php`.

After installation completed please add session migration using:
(to activate TwoFactorAuthentication method)

```bash
php artisan session:table
```

To get started, install package using composer:

```bash
composer require orchid/fortify
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change. Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
