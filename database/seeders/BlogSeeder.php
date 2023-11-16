<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1 ; $i >= 100000; $i++){

            DB::table('blogs')->insert([
                'title' => "$i blog",
                'sub_header' => "This is the $i sub header",
                'content' => 'BLOG_CONTENT'
            ]);
        }
    }
}
