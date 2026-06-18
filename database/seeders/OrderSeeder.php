<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Porudžbina 1 — user_id 3 (user@pwa.rs)
        Order::create(['user_id' => 3, 'status' => 'isporučeno', 'total' => 4800]);
        OrderItem::create(['order_id' => 1, 'wine_id' => 1, 'quantity' => 2, 'price' => 2400]);

        // Porudžbina 2 — user_id 4 (Marko)
        Order::create(['user_id' => 4, 'status' => 'potvrđeno', 'total' => 6400]);
        OrderItem::create(['order_id' => 2, 'wine_id' => 2, 'quantity' => 2, 'price' => 3200]);

        // Porudžbina 3 — user_id 5 (Jovana)
        Order::create(['user_id' => 5, 'status' => 'na čekanju', 'total' => 5400]);
        OrderItem::create(['order_id' => 3, 'wine_id' => 3, 'quantity' => 1, 'price' => 1800]);
        OrderItem::create(['order_id' => 3, 'wine_id' => 4, 'quantity' => 1, 'price' => 1500]);
        OrderItem::create(['order_id' => 3, 'wine_id' => 5, 'quantity' => 1, 'price' => 1200]);

        // Porudžbina 4 — user_id 3 (user@pwa.rs)
        Order::create(['user_id' => 3, 'status' => 'isporučeno', 'total' => 9500]);
        OrderItem::create(['order_id' => 4, 'wine_id' => 8, 'quantity' => 1, 'price' => 9500]);

        // Porudžbina 5 — user_id 4 (Marko)
        Order::create(['user_id' => 5, 'status' => 'potvrđeno', 'total' => 4000]);
        OrderItem::create(['order_id' => 5, 'wine_id' => 6, 'quantity' => 2, 'price' => 2000]);
        // Porudžbina 6 - user_id 5 (Jovana)
        Order::create(['user_id'=> 5,'status'=> 'isporučeno', 'total' => 8100]);
        OrderItem::create(['order_id'=> 6, 'wine_id' => 9, 'quantity' => 6, 'price' => 1350]);
    }
}


