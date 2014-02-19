<?php

namespace Mjolnic\Thor\Seeder;

use Seeder,
    DB,
    DateTime;

class LanguagesTableSeeder extends Seeder {

    public function run() {
        $languages = array(
            array(
                'name' => 'Español',
                'code' => 'es',
                'is_active' => 1,
                'sorting' => 1,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name' => 'English',
                'code' => 'en',
                'is_active' => 1,
                'sorting' => 2,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('languages')->insert($languages);
    }

}
