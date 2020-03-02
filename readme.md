<p align="center"><img src="http://efaastr.egov.mv/training/govmvefaaslogo2.png" width="200"></p>

## About Efaas

### The solution to manage your online identity

Free and secure online identity management solution by the government for the citizens and expatriates.

eFaas is designed to prevent identity fraud and protect user privacy, making sure the right people are given access to the services.

## Files to lookup
- Include Composer.json ("jumbojett/openid-connect-php": "^0.8.0")
- App/http/middleware/ CustomAuthMiddleware.php
- App/http/Controllers/Auth/LoginController.php
- Disable CsrfToken for callback (Please DO NOT COPY AND PAST THIS CODE)

```
namespace App\Http\Middleware;
use illuminate\Foundation\Http\Middleware\VerifyCsrToken as Middleware;

Class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'oauth/efaas/callback'
    ];
}
```


## Setup

git clone

composer install

setup .env file according to your environment

php artisan migrate

done!

## Test Fake User
user name: A000333
password: @123456
