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
            ['name' => 'Trijumf Barrique', 'price' => 2400, 'year' => 2019, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToVixZa-lCMKgIMqSrLXhsIW9Ci3jiFYBCVghmbDo9iA&s=10', 'featured' => true,  'stock' => 30, 'category' => 'Belo vino',   'winery' => 'Vinarija Aleksandrović', 'description' => 'Elegantno belo vino, sazrevalo u hrastovim bačvama.'],
            ['name' => 'Crni Kamen',       'price' => 3200, 'year' => 2018, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfmyzHG505SK2tsud2euqAGzOotS5zyxew4cqmc9TFaw&s=10', 'featured' => true,  'stock' => 20, 'category' => 'Crveno vino',  'winery' => 'Vinarija Matalj',        'description' => 'Moćno crveno vino sa notama tamnog voća.'],
            ['name' => 'Aurelius',         'price' => 1800, 'year' => 2020, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWZnGPP1m1qfMSceWrEt1vkyxAirojMveNC89dgAFdDg&s=10', 'featured' => false, 'stock' => 45, 'category' => 'Belo vino',   'winery' => 'Vinarija Kovačević',     'description' => 'Sveže belo vino, idealno uz ribu.'],
            ['name' => 'Vranac Reserve',   'price' => 1500, 'year' => 2017, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeybYdyUZbccSn9hr6t2Bc2P_jPF2KzqrPaUFAmH7JyQ&s=10', 'featured' => true,  'stock' => 25, 'category' => 'Crveno vino',  'winery' => 'Vinarija Radovanović',   'description' => 'Tradicionalni vranac sa bogatim ukusom.'],
            ['name' => 'Rosé Premium',     'price' => 1200, 'year' => 2021, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEVXeiZnNt_Ks0Omey5Pk5tCCTSQEJZouiSZsrXKG7Og&s=10', 'featured' => false, 'stock' => 50, 'category' => 'Rose',         'winery' => 'Vinarija Temet',         'description' => 'Lagano rozé vino, savršeno za leto.'],
            ['name' => 'Brut Spumante',    'price' => 2000, 'year' => 2020, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSr_YBkKaOt7jFrdpXIdZlTWoLbDcsCvLwhydJn6DszTA&s=10', 'featured' => true,  'stock' => 18, 'category' => 'Penušavo',     'winery' => 'Vinarija Kovačević',     'description' => 'Penušavo vino za svečane trenutke.'],
            ['name' => 'Tamjanika Sweet',  'price' => 1600, 'year' => 2019, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQInZWPKz0l67AByvGsv1bgVv359lVfAd6X-Z4Oxhs-4w&s=10', 'featured' => false, 'stock' => 35, 'category' => 'Desertno',     'winery' => 'Vinarija Temet',         'description' => 'Slatko desertno vino sa aromom tamjanike.'],
            ['name' => 'Grand Cru',        'price' => 9500, 'year' => 2015, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ45XXtH8DWO9E2VhkLJd6FxZBxV3ChZCa2Ch_kURbCsg&s=10', 'featured' => true,  'stock' => 8,  'category' => 'Crveno vino',  'winery' => 'Château Margaux',        'description' => 'Vrhunsko bordoško vino, kolekcionarski primerak.'],
            ['name' => 'Tamjanika Stota Suza','price'=>1350,'year'=>2022, 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-LFLDj_nDRnDBpWM7z6DP1HyRkzY3PEcgv9OqWZZbSQ&s=10','featured'=>true,'stock'=>42,'category'=>'Belo vino','winery'=>'Vinska Kuca Minic','description'=>'Vrhunsko suvo stono vino sa istaknutim cvetnim mirisima'],
        ];
        foreach ($wines as $w) {
            Wine::create([
                'name'        => $w['name'],
                'description' => $w['description'],
                'price'       => $w['price'],
                'year'        => $w['year'],
                'image'       => $w['image'],
                'featured'    => $w['featured'],
                'stock'       => $w['stock'],
                'category_id' => $cat[$w['category']],
                'winery_id'   => $win[$w['winery']],
            ]);
        }
    }
}