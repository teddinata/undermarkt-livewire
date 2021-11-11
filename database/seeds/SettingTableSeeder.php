<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'admin_title'   => 'Undermarkt Store — Toko Online Sayur No. 1 di Indonesia',
            'admin_footer'  => 'Undermarkt Store — Toko Online Sayur No. 1 di Indonesia',
            'site_title'    => 'Undermarkt Store — Toko Online Sayur No. 1 di Indonesia',
            'site_footer'   => 'Undermarkt Store — Toko Online Sayur No. 1 di Indonesia',
            'email_recived' => 'youremail@gmail.com',
            'city'          => 'logo.png',
            'keywords'      => 'Undermarkt Store',
            'description'   => 'Undermarkt — Toko Online Sayur No. 1 di Indonesia'
        ]);
    }
}
