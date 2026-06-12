![Composer status](.github/composer.svg)
![Coverage status](.github/coverage.svg)
![NPM status](.github/npm.svg)
![PHP version](.github/php.svg)
![Tests status](.github/tests.svg)

# Support Page

Allows you quickly add a support page to your project

## What's in the box?

* Laravel Blade Support Page and administration
   * Available in GOV.UK or Bulma designs 
* PHP 8.3

## Installation

`composer require networkrailbusinesssystems/support-page`

## Setup

### Pre-requisites

The Support Page library requires the [Form Builder](https://github.com/AnthonyEdmonds/laravel-form-builder) route macro.

### Publish files

All essential files are published via `php artisan vendor:publish` under the `support-page` tag.

This includes the support-page config and migration files.

#### support-page-views

If you need to override the blades, the `support-page-views` tag will publish them for the selected template.

### Routing

Two route macros are provided to handle the Support Page and its Admin functions. 

As an example, add the following to your `routes/web.php` file:
```php
Route::supportPage();

Route::middleware('auth')
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        Route::supportPageAdmin();
    });
```

* Add the permission`'manage_support_page'` with admin rights.
* Add a 'Manage Support Details' link to the admin blade with the route `support-page.admin.index` and wrap the section with `@can`:
```php
@can('manage_support_page')
    <li>
        <x-govuk::a href="{{ route('support-page.admin.index') }}">
            Manage Support Details
        </x-govuk::a>
    </li>
@endcan
```

* Register the form `SupportDetailForm::class` in the [GOVUK Config](https://github.com/AnthonyEdmonds/govuk-laravel/blob/main/docs/configuration.md).
* Update permissions and run database migrations.

## Configuration

There are three configurable values in the Support-page config:

| Option             | Type   | Default                              | Usage                                                                  |
|--------------------|--------|--------------------------------------|------------------------------------------------------------------------|
| support_page_title | string | Support                              | Customise the title of the support page                                |
| enquiry_route      | string | enquiry                              | Customise the enquiry page link                                        |
| excluded_roles     | array  | []                                   | Exclude these roles from being assignable contacts for Support Details |
| permission         | string | manage_support_page                  | Permission to manage the support page                                  |
| role_model         | model  | Spatie\Permission\Models\Role::class | Set the Role Model to use                                              |
| user_model         | model  | App\Models\User::class               | Set the User Model to use                                              |
