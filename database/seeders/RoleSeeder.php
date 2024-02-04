<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    use DisableForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        User::find(1)->assignRole('admin');

        $this->enableForeignKeys();
    }

}
