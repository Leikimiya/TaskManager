<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = ['Новая', 'В работе', 'Завершена'];
        foreach ($names as $name){
            DB::table('statuses')->insert([
                'name'=>$name
            ]);
        }
    }
}
