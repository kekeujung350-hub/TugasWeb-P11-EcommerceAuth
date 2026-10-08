<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $customers = User::factory(10)->create();           // role default: user
        $customers->push(User::where('email', 'user@example.com')->first());

        foreach ($customers as $user) {
            $address = Address::create([
                'user_id' => $user->id,
                'label' => 'Rumah',
                'recipient' => $user->name,
                'phone' => fake()->numerify('08##########'),
                'street' => fake()->streetAddress(),
                'city' => fake()->city(),
                'postal_code' => fake()->postcode(),
            ]);

            for ($i = 0; $i < rand(1, 2); $i++) {
                $status = fake()->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']);

                $order = Order::create([
                    'user_id' => $user->id,
                    'address_id' => $address->id,
                    'order_number' => 'INV-'.strtoupper(Str::random(8)),
                    'status' => $status,
                    'total' => 0,
                ]);

                $total = 0;
                foreach ($products->random(rand(1, 3)) as $product) {
                    $qty = rand(1, 3);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'unit_price' => $product->price,
                    ]);
                    $total += $qty * $product->price;
                }
                $order->update(['total' => $total]);

                $paid = ! in_array($status, ['pending', 'cancelled']);
                Payment::create([
                    'order_id' => $order->id,
                    'method' => fake()->randomElement(['transfer', 'ewallet', 'cod']),
                    'amount' => $total,
                    'status' => $paid ? 'success' : ($status === 'cancelled' ? 'failed' : 'pending'),
                    'paid_at' => $paid ? now() : null,
                ]);
            }

            foreach ($products->random(3) as $product) {
                Review::firstOrCreate(
                    ['user_id' => $user->id, 'product_id' => $product->id],
                    ['rating' => rand(3, 5), 'comment' => fake()->sentence(8)]
                );
            }
        }
    }
}
