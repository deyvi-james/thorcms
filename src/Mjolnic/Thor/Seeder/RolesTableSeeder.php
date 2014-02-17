<?php

namespace Mjolnic\Thor\Seeder;

use Seeder,
    DB,
    User,
    Role;

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->truncate();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'comment';
        $commentRole->save();

        $user = User::where('username', '=', 'admin')->first();
        $user->attachRole($adminRole);

        $user = User::where('username', '=', 'user')->first();
        $user->attachRole($commentRole);
    }

}
