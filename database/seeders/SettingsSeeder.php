<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['key' => '', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'favicon', 'value' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
