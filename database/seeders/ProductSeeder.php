<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 6 kategori x 9 produk = 54 produk realistis (harga dalam Rupiah)
        $catalog = [
            'Elektronik' => [
                'Samsung Galaxy A55 5G' => 5990000,
                'Xiaomi Redmi Note 13' => 2799000,
                'Logitech M331 Silent Plus Mouse' => 189000,
                'Anker PowerCore 10000mAh' => 359000,
                'JBL Tune 510BT Headphone' => 499000,
                'Lenovo IdeaPad Slim 3' => 7499000,
                'Asus Vivobook 14 A1405' => 8299000,
                'Baseus GaN Charger 65W' => 399000,
                'TP-Link Archer C6 Router AC1200' => 449000,
            ],
            'Fashion' => [
                'Kaos Polos Cotton Combed 30s' => 59000,
                'Kemeja Flanel Lengan Panjang' => 149000,
                'Celana Chino Slim Fit' => 189000,
                'Jaket Hoodie Fleece' => 179000,
                'Sepatu Sneakers Canvas' => 229000,
                'Tas Ransel Laptop 15 Inci' => 199000,
                'Topi Baseball Polos' => 49000,
                'Jilbab Instan Bergo' => 69000,
                'Sandal Jepit Premium' => 59000,
            ],
            'Buku & Alat Tulis' => [
                'Atomic Habits (Edisi Indonesia)' => 99000,
                'Laskar Pelangi' => 85000,
                'Clean Code - Robert C. Martin' => 450000,
                'Buku Tulis Sinar Dunia 38 Lembar (isi 10)' => 32000,
                'Pulpen Pilot G2 0.5mm' => 18000,
                'Stabilo Boss Highlighter Set 4 Warna' => 59000,
                'Kalkulator Casio fx-991EX' => 349000,
                'Map Plastik Clear Holder (isi 12)' => 24000,
                'Binder Notebook A5 Kanvas' => 45000,
            ],
            'Perlengkapan Rumah' => [
                'Rice Cooker Miyako 1.8L' => 349000,
                'Panci Set Stainless 5 Pcs' => 299000,
                'Teko Listrik Philips 1.7L' => 275000,
                'Setrika Uap Philips' => 389000,
                'Sapu Lantai Set + Pengki' => 59000,
                'Tumbler Stainless 1L' => 89000,
                'Kipas Angin Berdiri Cosmos' => 449000,
                'Lampu LED Philips 14W (isi 4)' => 129000,
                'Dispenser Air Sanken' => 599000,
            ],
            'Makanan & Minuman' => [
                'Kopi Sidikalang Arabika 250g' => 75000,
                'Teh Celup Sariwangi 25 Sachet' => 12000,
                'Indomie Goreng 1 Dus (40 Pcs)' => 125000,
                'Madu Hutan Murni 500ml' => 95000,
                'Pringles Original 107g' => 24000,
                'Biskuit Roma Kelapa 300g' => 14000,
                'Susu UHT Ultra Milk Cokelat 1L' => 21000,
                'Minyak Goreng Bimoli 2L' => 38000,
                'Beras Pandan Wangi 5kg' => 78000,
            ],
            'Olahraga' => [
                'Matras Yoga TPE 6mm' => 99000,
                'Dumbbell Vinyl 5kg (Sepasang)' => 159000,
                'Raket Badminton Yonex Astrox 01 Clear' => 549000,
                'Bola Futsal Molten F9A1000' => 299000,
                'Skipping Rope Speed' => 39000,
                'Sepatu Lari Ortuseight' => 459000,
                'Botol Shaker 700ml' => 45000,
                'Resistance Band Set 5 Pcs' => 85000,
                'Jersey Dry-Fit Running' => 119000,
            ],
        ];

        foreach ($catalog as $categoryName => $items) {
            $category = Category::factory()->create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => "Produk kategori {$categoryName}.",
            ]);

            foreach ($items as $name => $price) {
                Product::factory()->create([
                    'category_id' => $category->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => "{$name} - produk original kategori {$categoryName}. Garansi toko 7 hari.",
                    'price' => $price,
                ]);
            }
        }
    }
}
