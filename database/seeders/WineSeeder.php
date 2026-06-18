<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Wine;
use App\Models\Winery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pluck vraca kao kljuc vraca ime (kategodije ili vinarije), a kao vrednost vraca id tako da kada u for petlji pozovem ovu promenljivu i prosledim joj kljuc $w['category'], ona pomocu te vrednosti npr. Penušavo vraća id te kategorije. to isto radi i za vinariju. Ova metoda može da bude korisna u ovakvim situacijama kada je lakše zapamtiti tekstualnu vrednost nekog polja nego njen id
        $cat = Category::pluck('id', 'name');
        $win = Winery::pluck('id', 'name');
    
        $wines = [
            ['name' => 'Trijumf Barrique', 'price' => 2400, 'year' => 2019, 'featured' => true,  'stock' => 30, 'category' => 'Belo vino',   'winery' => 'Vinarija Aleksandrović', 'description' => 'Elegantno belo vino, sazrevalo u hrastovim bačvama.'],
            ['name' => 'Crni Kamen',       'price' => 3200, 'year' => 2018, 'featured' => true,  'stock' => 20, 'category' => 'Crveno vino',  'winery' => 'Vinarija Matalj',        'description' => 'Moćno crveno vino sa notama tamnog voća.'],
            ['name' => 'Aurelius',         'price' => 1800, 'year' => 2020, 'featured' => false, 'stock' => 45, 'category' => 'Belo vino',   'winery' => 'Vinarija Kovačević',     'description' => 'Sveže belo vino, idealno uz ribu.'],
            ['name' => 'Vranac Reserve',   'price' => 1500, 'year' => 2017, 'featured' => true,  'stock' => 25, 'category' => 'Crveno vino',  'winery' => 'Vinarija Radovanović',   'description' => 'Tradicionalni vranac sa bogatim ukusom.'],
            ['name' => 'Rosé Premium',     'price' => 1200, 'year' => 2021, 'featured' => false, 'stock' => 50, 'category' => 'Rose',         'winery' => 'Vinarija Temet',         'description' => 'Lagano rozé vino, savršeno za leto.'],
            ['name' => 'Brut Spumante',    'price' => 2000, 'year' => 2020, 'featured' => true,  'stock' => 18, 'category' => 'Penušavo',     'winery' => 'Vinarija Kovačević',     'description' => 'Penušavo vino za svečane trenutke.'],
            ['name' => 'Tamjanika Sweet',  'price' => 1600, 'year' => 2019, 'featured' => false, 'stock' => 35, 'category' => 'Desertno',     'winery' => 'Vinarija Temet',         'description' => 'Slatko desertno vino sa aromom tamjanike.'],
            ['name' => 'Grand Cru',        'price' => 9500, 'year' => 2015, 'featured' => true,  'stock' => 8,  'category' => 'Crveno vino',  'winery' => 'Château Margaux',        'description' => 'Vrhunsko bordoško vino, kolekcionarski primerak.'],
            ['name' => 'Tamjanika Stota Suza','price'=>1350,'year'=>2022,'featured'=>true,'stock'=>42,'category'=>'Belo vino','winery'=>'Vinska Kuca Minic','description'=>'Vrhunsko suvo stono vino sa istaknutim cvetnim mirisima'],
        ];
        foreach ($wines as $w) {
            Wine::create([
                'name'        => $w['name'],
                'description' => $w['description'],
                'price'       => $w['price'],
                'year'        => $w['year'],
                'featured'    => $w['featured'],
                'stock'       => $w['stock'],
                'category_id' => $cat[$w['category']],
                'winery_id'   => $win[$w['winery']],
            ]);
        }
    }
}