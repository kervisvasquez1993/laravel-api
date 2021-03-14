<?php
namespace App;
namespace Database\Seeders;

use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* DB::statement('SET FOREING_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();
        
        $cantidadUsuario = 200;
        $categoriaCategoria = 30;
        $cantidadProducto = 1000;
        $cantidadTransacciones = 1000;

        factory(User::class, $cantidadUsuario)->create();
        factory(Category::class, $categoriaCategoria)->create();
       

        factory(Transaction::class, $cantidadTransacciones)->create(); */

        $this->call(PruebaSeeder::class);

    }
}
