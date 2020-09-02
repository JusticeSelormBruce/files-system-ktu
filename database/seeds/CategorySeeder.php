<?php
use App\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::create(
            [
                "name"=>"System Administrator"
            ]
        );
       
        Categories::create(
            [
                "name"=>"VC"
            ]
        );
        Categories::create(
            [
                "name"=>" Pro VC"
            ]
        );
        Categories::create(
            [
                "name"=>"Deans"
            ]
        );
        Categories::create(
            [
                "name"=>"HOD"
            ]
        );
        Categories::create(
            [
                "name"=>"Staff"
            ]
        );
       
       
    }
}
