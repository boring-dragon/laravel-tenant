# Laravel Tenant (Belongs to tenant)

[![StyleCI](https://github.styleci.io/repos/323338609/shield?branch=master)](https://github.styleci.io/repos/323338609?branch=master)

This package automatically scopes the queries to a tenant. Listens for a created events and set the tenant_id automatically. Just a test package I made would not recommend to use it


## Installation

You can install the package via composer:

```bash
composer require jinas123/laravel-tenant
```

## Usage

Add the `HasTenant` trait into your user model. Make sure to add a `tenant_id` column into your user table 
``` php
use Jinas\LaravelTenant\Traits\HasTenant;

class User extends Authenticatable 
{
    use HasTenant;
}
```

Any model that uses `HasTenant` Should include `tenant_id` in their database table.

### Testing

``` bash
composer test
```

### Security

If you discover any security related issues, please email j@live.mv instead of using the issue tracker.

## Credits

- [Mohamed Jinas](https://github.com/boring-dragon)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
