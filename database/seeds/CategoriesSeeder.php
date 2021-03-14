<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'categoria1',
            'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum eveniet quaerat nisi fugit dicta earum dolore. Recusandae illum perferendis asperiores repellat voluptatibus sunt nihil dolores ab natus, tenetur quidem?"
        ]);
    }
}
