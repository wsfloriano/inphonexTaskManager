<?php

use Illuminate\Database\Seeder;
use App\Type;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name'=>'Shopping']);
        Type::create(['name'=>'Work']);
    }
}
