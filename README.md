# Support Page

Use the Support Page Library with GOV.UK Laravel to insert a support page and support admin page.

## What's in the box?

* Laravel 10 Blade GOV.UK Design support page and support admin page
* Laravel 10 Blade GOV.UK Design support page components
* PHP 8.2

## Installation

Via Composer: `composer require networkrailbusinesssystems/support-page`

Publish via the terminal: `php artisan vendor:publish --provider="NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider"`

## Configuration

* Add `'manage_support_page'` with admin rights to the UpdatePermissions Command
* Add a support admin page link to admin blade and surround it with `@can'manage_support_page'`
* Add `Route::supportPage();` to web.php

* Register the form in the Govuk config:
```php
return [
'forms' => [
SupportDetailForm::class,
],
```
* run `php artisan update:permissions` and `php artisan migrate` in the terminal

NOT REQUIRED AFTER TEMPLATE UPDATE:

Add
'Support' => [
'auth' => true,
'link' => route('support'),
],
to head.blade in govuk layout

Update user model to have 

public function scopeByRole(Builder $query, string $role, string $column = 'name'): Builder
{
return $query->whereHas('roles', function (Builder $query) use ($role, $column) {
$query->where($column, '=', $role);
});
}


## Environment variables

```dotenv
    USER_MODEL=User::class
    SUPPORT_DETAIL_MODEL=SupportDetail::class
    SUPPORT_DETAIL_COLLECTION=SupportDetailCollection::class
```

* Set for Searching by item or description from Oracle.

```dotenv
    ORACLE_CATALOGUE_GET_HOST=
 ```

Then you can use the OracleCatalogueHelper class functions in your project for item search:

```php
use NetworkRailBusinessSystems\OracleApi\OracleCatalogueHelper;

$response = OracleCatalogueHelper::search('016798 or FENCE', limit = 100); // search by item code or description 
$response = OracleCatalogueHelper::searchByCode('0004/016798', limit = 100); // search by item code 
$response = OracleCatalogueHelper::searchByDescription('FENCE', limit = 100);  // search by item description
```

* Set for Order submission.

```dotenv
    ORACLE_CATALOGUE_POST_HOST=
```
Then you can use the OracleCatalogueHelper class function for order submission:


The Oracle API package makes use of the [Laravel Http Client](https://laravel.com/docs/10.x/http-client).
This enables you to fake the Http response in your test, so it doesn't need a live connection to the Oracle API.

* Set for fake search response and order submission.

```dotenv
    ORACLE_CATALOGUE_EMULATOR=true
```

```php
Http::fake([
    '*' => Http::response([
            "ItemCode" => "0004/016798",
            "ItemDescription" => "POST FENCE  INTERMDT 6 HOLE",
            "ItemYourPrice" => 50.95,
            "Status" => "NR SUPER",
            "PackSize" => "1",
            "IBECustomAttribute15" => null,
            "ConfigurableItem" => null,
            "ItemPrimaryUOMCode" => null,
            "MiniSiteName" => "Non-Heavy Products"
    ]),
]);
```