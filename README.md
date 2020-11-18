# A json response helper for lumen | laravel.

### Installation

Install the package via composer: `composer require iluckin/json-response-helper`

In Laravel 5.5, the service provider and facade will automatically get registered. For older versions of the framework, follow the steps below:

Register the service provider in Laravel config/app.php

```php
'providers' => [
    \LuckIn\Api\Helper\LaravelServiceProvider::class
],
```

Register the service provider in Lumen bootstrap/app.php

```php
$app->register(\LuckIn\Api\Helper\LumenServiceProvider::class);
```

### Config

To adjust the library, you can publish the config file to your Laravel project using:
```php
php artisan vendor:publish --provider="\LuckIn\Api\Helper\LaravelServiceProvider"
```

To adjust the library, you can publish the config file to your Lumen project using:
```php
$ cp $VENDOR/iluckin/json-response-helper/config/json-helper.php $PROJECTDIR/config/json-helper.php
```

json-helper.php

```php
<?php

return [

    /*
	|--------------------------------------------------------------------------
	| Response JSON keys mapping
	|--------------------------------------------------------------------------
	|
	| You can remap response JSON keys if really needed.
	|
	|
	| WARNING: there's NO duplicate check at runtime, so if you remap two keys
	| to the same values you will end up with problems. There's testing trait
	| to prevent this from happening, so ensure you unit test your app !
	|
	| if you want to use custom mapping.
	|
	| It's safe to completely remove/comment out this config element.
	|
	*/

	'response_key_map' => [
        \LuckIn\Api\Helper\JsonResponse::KEY_MESSAGE => 'msg',
        \LuckIn\Api\Helper\JsonResponse::KEY_CODE    => 'code',
        \LuckIn\Api\Helper\JsonResponse::KEY_DATA    => 'data',
	],


    /*
	|--------------------------------------------------------------------------
	| Response JSON with global headers
	|--------------------------------------------------------------------------
	|
	| response json with global http headers
	|
	|
	*/

    'global_headers' => [
        // 'X-AUTH-ID' => '...'
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Response meta data defaults
    |--------------------------------------------------------------------------
    |
    | Response meta data defaults
    |
    |
    */

    'response_meta_default' => [
        'code' => 0,
        'data' => [],
        'message' => 'ok'
    ],
    
    // ...
];
```

### Usage

It's simple. Using success | fail helper as:

```php
return success(
    $data = [], $message = 'ok', $code = 2000
);

return fail(
    $message = 'fail', $code = 5000, $data = []
);
```