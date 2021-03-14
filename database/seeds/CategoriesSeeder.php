<?php

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
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
        /* DB::table('categories')->insert([
            'name' => 'categoria1',
            'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum eveniet quaerat nisi fugit dicta earum dolore. Recusandae illum perferendis asperiores repellat voluptatibus sunt nihil dolores ab natus, tenetur quidem?"
        ]); */

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();
        
        $cantidadUsuario = 200;
        $categoriaCategoria = 30;
        $cantidadProducto = 1000;
        $cantidadTransacciones = 1000;

        factory(User::class, 200)->create();
        factory(Category::class, 30)->create();
        factory(Product::class, $cantidadProducto)->create()->each(
            function($producto)
            {
                $categorias = Category::all()->random(mt_rand(1,5))->pluck('id');

                $producto->categories()->attach($categorias);
            }
        );

        factory(Transaction::class, $cantidadTransacciones)->create();
    }
}
