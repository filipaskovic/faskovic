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
            ['name' => 'Vinarija Aleksandrović', 'region' => 'Šumadija', 'country' => 'Srbija', 'description' => '<p>Jedna od najpoznatijih srpskih vinarija, poznata po Trijumfu.</p>','logo'=>'','image'=>'https://lh3.googleusercontent.com/gps-cs-s/APNQkAHc-gGaYw-5nvg3pceyZ7q9Pa8n1ljDXfSXvB0WSNvqxFmtBslUBrrbghprcbgvTKLhkLAg48p8JcDpWZGiMi8a9nChOXDsMKwF0v7WrMEBdh30t1atybDeBmNKOMW9h21Mc9Sa=s1360-w1360-h1020-rw'],
            ['name' => 'Vinarija Radovanović', 'region' => 'Krnjevo', 'country' => 'Srbija', 'description' => '<p>Porodična vinarija sa dugom tradicijom.</p>','logo'=>'','image'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXASZaJgePyBPaKVjtQPNhdjA5EgLzRSrKFW9JR9C9pzxickYQM9W4398&s=10'],
            ['name' => 'Vinarija Matalj', 'region' => 'Negotinska Krajina', 'country' => 'Srbija', 'description' => '<p>Poznata po vrhunskom Crnom Kamenu.</p>','logo'=>'','image'=>'https://www.barriquenis.rs/wp-content/uploads/2025/03/Vinarija_Matalj_1-1024x461.jpg'],
            ['name' => 'Vinarija Kovačević', 'region' => 'Fruška Gora', 'country' => 'Srbija', 'description' => '<p>Najveća vinarija na Fruškoj gori.</p>','logo'=>'','image'=>'https://novisad.travel/wp-content/uploads/2021/09/Vinarija-Kovacevic-ACA_2082_compressed.jpg'],
            ['name' => 'Vinarija Temet', 'region' => 'Župa', 'country' => 'Srbija', 'description' => '<p>Moderna vinarija iz srca Župe.</p>','logo'=>'','image'=>'https://organskovino.rs/wp-content/uploads/2023/08/objekat-dron.jpg'],
            ['name' => 'Château Margaux', 'region' => 'Bordeaux', 'country' => 'Francuska', 'description' => '<p>Legendarna francuska vinarija.</p>','logo'=>'','image'=>'https://cdn.mos.cms.futurecdn.net/o8RciNRXeXgKKezCDAFdgS-1300-80.jpg.webp'],
            ['name' => 'Vinska Kuca Minic', 'region' => 'Župa', 'country' => 'Srbija', 'description' => '<p>Vinarija sa dugom tradicijom prepoznatljiva po tamnjanici.</p>','logo'=>'','image'=>'https://vinskakucaminica.com/wp-content/uploads/slider/cache/d0d29a2599330bd1219182149d57c23b/sl2-avlija.jpg'],

    ];
        foreach($wineries as $w){
        Winery::create($w);
        }
    }
}
