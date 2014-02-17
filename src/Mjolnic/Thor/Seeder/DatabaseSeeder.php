<?php

namespace Mjolnic\Thor\Seeder;

use Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        // Add calls to Seeders here
        $this->call('Mjolnic\Thor\Seeder\UsersTableSeeder');
        $this->call('Mjolnic\Thor\Seeder\RolesTableSeeder');
        $this->call('Mjolnic\Thor\Seeder\PermissionsTableSeeder');
        $this->call('Mjolnic\Thor\Seeder\LanguagesTableSeeder');
    }

}
