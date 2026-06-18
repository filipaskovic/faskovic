<?php

namespace Database\Seeders;

use App\Models\Winery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WinerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wineries = [
            ['name' => 'Vinarija Aleksandrović', 'region' => 'Šumadija', 'country' => 'Srbija', 'description' => 'Jedna od najpoznatijih srpskih vinarija, poznata po Trijumfu.'],
            ['name' => 'Vinarija Radovanović', 'region' => 'Krnjevo', 'country' => 'Srbija', 'description' => 'Porodična vinarija sa dugom tradicijom.'],
            ['name' => 'Vinarija Matalj', 'region' => 'Negotinska Krajina', 'country' => 'Srbija', 'description' => 'Poznata po vrhunskom Crnom Kamenu.'],
            ['name' => 'Vinarija Kovačević', 'region' => 'Fruška Gora', 'country' => 'Srbija', 'description' => 'Najveća vinarija na Fruškoj gori.'],
            ['name' => 'Vinarija Temet', 'region' => 'Župa', 'country' => 'Srbija', 'description' => 'Moderna vinarija iz srca Župe.'],
            ['name' => 'Château Margaux', 'region' => 'Bordeaux', 'country' => 'Francuska', 'description' => 'Legendarna francuska vinarija.'],
            ['name' => 'Vinska Kuca Minic', 'region' => 'Župa', 'country' => 'Srbija', 'description' => 'Vinarija sa dugom tradicijom prepoznatljiva po tamnjanici.'],

    ];
        foreach($wineries as $w){
        Winery::create($w);
        }
    }
}
