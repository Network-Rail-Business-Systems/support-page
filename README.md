# Support Page

Use the Support Page Library with GOV.UK Laravel to insert a support page and support admin page.

## What's in the box?

* Laravel 10 Blade GOV.UK Design support page and support page admin
* Laravel 10 Blade GOV.UK Design support page components
* PHP 8.2

## Installation

Via Composer: `composer require networkrailbusinesssystems/support-page`

Publish via the terminal: `php artisan vendor:publish --provider="NetworkRailBusinessSystems\SupportPage\Providers\SupportPageProvider"`

## Configuration

* Add `'manage_support_page'` with admin rights to the UpdatePermissions Command
* Add a link to manage Support Details on the admin blade with the route `support-page.admin.index` and wrap it in `@can'manage_support_page'`
* Add `Route::supportPage();` to web.php

* Register the form and import the class in the Govuk config:
```php
return [
    'forms' => [
        SupportDetailForm::class,
],
```
* run `php artisan update:permissions` and `php artisan migrate` in the terminal

* If required, exclude roles from being an assignable contact for a support detail by adding the role to the registering them form in the Support-page config:

```php
'excluded_roles' => ['Developer', 'Business Systems Support'],
```

## Testing information

Need to make some tests

## Notes

This library was created from Network Rails template, using a branch created support page and support page admin.

This branch is yet to be merged yet and  includes a change to the User Model which is required for this library:

* Update the User Model Method scopeByRole:
```php
public function scopeByRole(Builder $query, string $role, string $column = 'name'): Builder
{
    return $query->whereHas('roles', function (Builder $query) use ($role, $column) {
        $query->where($column, '=', $role);
    });
}
```
An additional request when working on this library included adding the support page to the Navbar.

* Update the header.blade in govuk->layout:
```php
'Support' => [
    'auth' => true,
    'link' => route('support'),
],
```
The Model update will be merged as it is an approved PR.

The GOVUK update will be required to be created and submitted as a PR
