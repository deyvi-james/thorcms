<?php

namespace Mjolnic\Thor\Seeder;

use Seeder,
    DB;

class PagesTableSeeder extends Seeder {

    public function run() {
        $items = array(
            array(
                'is_deletable' => false,
                'sorting' => 1
            ),
            array(
                'is_deletable' => false,
                'sorting' => 2
            )
        );

        DB::table('pages')->insert($items);

        foreach (\Language::orderBy('sorting')->get() as $lang) {
            $items2 = array(
                array(
                    'language_id' => $lang->id,
                    'page_id' => 1,
                    'title' => 'Home (' . $lang->code . ')',
                    'slug' => '/'
                ),
                array(
                    'language_id' => $lang->id,
                    'page_id' => 2,
                    'title' => 'Error 404 (' . $lang->code . ')',
                    'slug' => 'error'
                )
            );

            DB::table('page_texts')->insert($items2);
        }
    }

}
