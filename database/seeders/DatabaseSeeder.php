<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Retailer;
use App\Models\Product;
use App\Models\MarketplaceListing;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a Test User
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $otherUser = User::factory()->create([
            'name' => 'PC Gamer 99',
            'email' => 'gamer99@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Retailers
        $tmt = Retailer::create([
            'name' => 'TMT',
            'website_url' => 'https://tmt.my',
            'logo_path' => null
        ]);
        
        $allit = Retailer::create([
            'name' => 'All IT Hypermarket',
            'website_url' => 'https://www.allithypermarket.com.my',
            'logo_path' => null
        ]);

        $harvey = Retailer::create([
            'name' => 'Harvey Norman',
            'website_url' => 'https://www.harveynorman.com.my',
            'logo_path' => null
        ]);

        // 3. Create Products (PC Parts)
        $gpu = Product::create([
            'name' => 'NVIDIA GeForce RTX 4090 24GB',
            'category' => 'Graphics Card',
            'brand' => 'NVIDIA',
            'description' => 'The ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.',
            'image_path' => null,
        ]);

        $cpu = Product::create([
            'name' => 'Intel Core i9-14900K',
            'category' => 'Processor',
            'brand' => 'Intel',
            'description' => '24 cores (8 P-cores + 16 E-cores) and 32 threads. Unlocked desktop processor.',
            'image_path' => null,
        ]);

        $ram = Product::create([
            'name' => 'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz',
            'category' => 'Memory',
            'brand' => 'Corsair',
            'description' => 'High performance DDR5 memory tailored for Intel motherboards.',
            'image_path' => null,
        ]);

        // 4. Attach Prices (Pivot Table)
        $gpu->retailers()->attach([
            $tmt->id => ['price' => 8599.00, 'availability_status' => 'In Stock', 'product_url' => 'https://tmt.my/rtx4090'],
            $allit->id => ['price' => 8650.00, 'availability_status' => 'Out of Stock', 'product_url' => 'https://allit.my/rtx4090'],
            $harvey->id => ['price' => 8999.00, 'availability_status' => 'In Stock', 'product_url' => 'https://harvey.my/rtx4090'],
        ]);

        $cpu->retailers()->attach([
            $tmt->id => ['price' => 2899.00, 'availability_status' => 'In Stock', 'product_url' => 'https://tmt.my/i9'],
            $allit->id => ['price' => 2850.00, 'availability_status' => 'In Stock', 'product_url' => 'https://allit.my/i9'],
        ]);

        $ram->retailers()->attach([
            $tmt->id => ['price' => 650.00, 'availability_status' => 'In Stock', 'product_url' => 'https://tmt.my/ram'],
            $allit->id => ['price' => 635.00, 'availability_status' => 'In Stock', 'product_url' => 'https://allit.my/ram'],
            $harvey->id => ['price' => 699.00, 'availability_status' => 'In Stock', 'product_url' => 'https://harvey.my/ram'],
        ]);

        // 5. Create Marketplace Listings (C2C)
        MarketplaceListing::create([
            'user_id' => $otherUser->id,
            'title' => 'Used RTX 3080 10GB - Excellent Condition',
            'category' => 'Graphics Card',
            'condition' => 'Used - Like New',
            'price' => 1800.00,
            'description' => 'Used for light gaming only. No mining. Original box included. COD in KL.',
            'location' => 'Kuala Lumpur',
            'status' => 'Active',
        ]);

        MarketplaceListing::create([
            'user_id' => $otherUser->id,
            'title' => 'AMD Ryzen 5 5600X',
            'category' => 'Processor',
            'condition' => 'Used - Acceptable',
            'price' => 550.00,
            'description' => 'Upgraded to AM5, so letting this go. Working perfectly.',
            'location' => 'Petaling Jaya',
            'status' => 'Active',
        ]);
        
        MarketplaceListing::create([
            'user_id' => $user->id,
            'title' => 'Corsair 850W Gold PSU',
            'category' => 'Power Supply',
            'condition' => 'New',
            'price' => 450.00,
            'description' => 'Brand new sealed in box. Bought the wrong wattage.',
            'location' => 'Subang Jaya',
            'status' => 'Active',
        ]);
    }
}
