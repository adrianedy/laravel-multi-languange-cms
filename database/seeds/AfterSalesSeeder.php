<?php

use Illuminate\Database\Seeder;

class AfterSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('after_sales')->insert([
            'slug' => 'spare-parts',
        ]);

        DB::table('after_sale_translations')->insert([
            'name' => 'Spare Parts',
            'locale' => 'en',
            'after_sale_id' => 1,
        ]);

        DB::table('after_sale_translations')->insert([
            'name' => 'Suku Cadang',
            'locale' => 'id',
            'after_sale_id' => 1,
        ]);

        DB::table('after_sales')->insert([
            'slug' => 'service-maintenance',
        ]);

        DB::table('after_sale_translations')->insert([
            'name' => 'Service Maintenance',
            'locale' => 'en',
            'after_sale_id' => 2,
        ]);

        DB::table('after_sale_translations')->insert([
            'name' => 'Pemeliharaan Layanan',
            'locale' => 'id',
            'after_sale_id' => 2,
        ]);
    }
}
