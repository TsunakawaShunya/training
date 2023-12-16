<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Part;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert([
            ['name' => '胸'],
            ['name' => '肩'],
            ['name' => '背中'],
            ['name' => '足'],
            ['name' => '腕'],
            ]);
    }
}
