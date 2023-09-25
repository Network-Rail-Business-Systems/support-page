<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePages extends Command
{
    protected $signature = 'update:pages';

    protected $description = 'Updates pages based on the matrix';

    const PAGES = [
        'Contact support' => ['support', null],
        'Dashboard' => ['dashboard', null],
        'Privacy & cookies' => ['privacy', null],
        'Search' => ['search.start', null],
        'Sign out' => ['sign-out', null],
        'Admin' => ['dashboard.admin', 'access_admin'],
        'Manage Users and Roles' => ['users.index', 'manage_users'],
    ];

    public function handle(): void
    {
        $this->info('Updating pages...');

        $this->deletePages();
        $this->makePages(self::PAGES);

        $this->info('Pages update complete!');
    }

    protected function deletePages(): void
    {
        $this->info('Deleting existing Pages...');
        DB::table('pages')->delete();
    }

    protected function makePages(array $pages): void
    {
        $this->info('Creating new Pages...');

        foreach ($pages as $name => $details) {
            $this->makePage($name, $details[0], $details[1]);
        }
    }

    protected function makePage(string $name, string $route, ?string $permission): void
    {
        $this->info("Creating {$name} Page...");

        Page::create([
            'name' => $name,
            'route' => $route,
            'permission' => $permission,
            'path' => route($route),
        ]);
    }
}
