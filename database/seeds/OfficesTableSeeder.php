<?php

use App\Offices;
use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offices::create(
            [
                "name"=>"Computer Science HOD",
                "departments_id"=> 1
            ]
        );
    }
}
