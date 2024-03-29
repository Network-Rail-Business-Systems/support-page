# Support Page

Use the Support Page Library to add the following to your GOV.UK Laravel library Project:

* Admin access to create, edit and delete Support Details.
* A Support Page to display Support Details.

## What's in the box?

* Laravel 10 Blade Support Page Admin Access in the GOV.UK Design
* Laravel 10 Blade Support Page in the GOV.UK Design 
* PHP 8.2

## Installation

Via Composer: `composer require networkrailbusinesssystems/support-page`

## Publish files

All essential files are published via the command `php artisan vendor:publish --provider="NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider"`.
This command includes the following two tags and their files:

### support-page

This command will publish the config and database migration:

* /config/support-page.php
* /database/migrations/2023_02_07_105304_create_support_details_table.php

### support-page-views

This command will publish the Blade views:

* /resources/views/details
* /resources/views/show.blade.php

## Routing

A route macro is provided to handle the Support Page, and it's Admin functions. Add the following to your `routes/web.php` file:
```php
Route::supportPage();
```

## Configuration

* Add the permission`'manage_support_page'` with admin rights.
* Add a 'Manage Support Details' link to the admin blade with the route `support-page.admin.index`. Wrap this section with `@can('manage_support_page')`, `@endcan`.
* Register the form `SupportDetailForm::class` in the [GOVUK Config](docs/configuration.md).
* Update permissions and run database migrations.
* You can exclude roles from being assignable contacts for Support Details by registering the roles in the Support-page config. Example:

```php
'excluded_roles' => ['Developer', 'Business Systems Support'],
```
