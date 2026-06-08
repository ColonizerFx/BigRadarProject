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
        // 1. Create Test Users
        $user = User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $otherUser = User::factory()->create([
            'name'     => 'PC Gamer 99',
            'email'    => 'gamer99@example.com',
            'password' => Hash::make('password'),
        ]);

        $seller2 = User::factory()->create([
            'name'     => 'TechSeller KL',
            'email'    => 'techseller@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Retailers (with real GPS coordinates in KL/MY)
        Retailer::create([
            'name'        => 'TMT',
            'website_url' => 'https://tmt.my',
            'logo_path'   => 'assets/logos/tmt.svg',
            'location'    => 'Mid Valley Megamall, KL',
            'latitude'    => 3.1180,
            'longitude'   => 101.6769,
        ]);
        Retailer::create([
            'name'        => 'All IT Hypermarket',
            'website_url' => 'https://www.allithypermarket.com.my',
            'logo_path'   => 'assets/logos/allit.svg',
            'location'    => 'Plaza Low Yat, KL',
            'latitude'    => 3.1457,
            'longitude'   => 101.7106,
        ]);
        Retailer::create([
            'name'        => 'Harvey Norman',
            'website_url' => 'https://www.harveynorman.com.my',
            'logo_path'   => 'assets/logos/harvey.svg',
            'location'    => 'Pavilion Bukit Jalil, KL',
            'latitude'    => 3.0580,
            'longitude'   => 101.6891,
        ]);
        Retailer::create([
            'name'        => 'Switch',
            'website_url' => 'https://www.switch.com.my',
            'logo_path'   => 'assets/logos/switch.svg',
            'location'    => 'The Gardens Mall, KL',
            'latitude'    => 3.1178,
            'longitude'   => 101.6763,
        ]);
        Retailer::create([
            'name'        => 'Apple Store',
            'website_url' => 'https://www.apple.com/my',
            'logo_path'   => 'assets/logos/apple.svg',
            'location'    => 'Pavilion KL',
            'latitude'    => 3.1488,
            'longitude'   => 101.7130,
        ]);

        // 3. Seed all products via ProductSeeder
        $this->call(ProductSeeder::class);

        // 4. Marketplace Listings (C2C) – with real images from References/pictures/MARKETPLACE LISTING/
        MarketplaceListing::create([
            'user_id'     => $otherUser->id,
            'title'       => 'Sapphire Pulse AMD Radeon RX 9060 XT 16GB',
            'category'    => 'Graphics Card',
            'condition'   => 'New (Open Box)',
            'price'       => 1450.00,
            'description' => 'Sapphire Pulse AMD Radeon RX 9060 XT 16GB GDDR6. Opened for testing only – never gamed. Full warranty intact. Box included.',
            'location'    => 'Kuala Lumpur',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/sapphire_pulse_amd_radeon_rx_9_1780461725_44f40fe4_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $otherUser->id,
            'title'       => 'RTX 2080 8GB Maxsun GPU',
            'category'    => 'Graphics Card',
            'condition'   => 'Used - Like New',
            'price'       => 880.00,
            'description' => 'Maxsun RTX 2080 8GB GDDR6 graphics card. Working perfectly. Triple fan cooling. COD available in KL/PJ area.',
            'location'    => 'Petaling Jaya',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/rtx_2080_8gb_maxsun_gpu_graphi_1780489284_35260801_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $seller2->id,
            'title'       => 'Sapphire Pulse RX 5600 XT 6GB GPU',
            'category'    => 'Graphics Card',
            'condition'   => 'Used - Good',
            'price'       => 420.00,
            'description' => 'Sapphire Pulse RX 5600 XT 6GB GDDR6. Used for gaming only, no mining. Tested and working. Original box included.',
            'location'    => 'Selangor',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/gpu_1779549959_cbd0fbf1_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $seller2->id,
            'title'       => 'MSI GeForce GTX 1080 Ti Armor 11GB',
            'category'    => 'Graphics Card',
            'condition'   => 'Used - Good',
            'price'       => 750.00,
            'description' => 'MSI GeForce GTX 1080 Ti Armor 11GB GDDR5X. Still very capable for 1080p/1440p gaming. Sold as-is.',
            'location'    => 'Kuala Lumpur',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/msi_geforce_gtx_1080_ti_armor__1780800357_13362744_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $user->id,
            'title'       => 'Intel Core i5-14500T 14th Gen CPU',
            'category'    => 'Processor',
            'condition'   => 'Used - Like New',
            'price'       => 720.00,
            'description' => 'Intel Core i5-14500T 14th Gen, LGA1700. Low-power T-series processor. Used briefly for testing. No cooler included.',
            'location'    => 'Kuala Lumpur',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/intel_core_i514500t_14th_gen_c_1780757314_97c72d28_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $otherUser->id,
            'title'       => 'Intel Celeron G3900 LGA1151 CPU',
            'category'    => 'Processor',
            'condition'   => 'Used - Good',
            'price'       => 65.00,
            'description' => 'Intel Celeron G3900 2.8GHz LGA1151. Pulled from working system. Budget CPU for office builds or NAS.',
            'location'    => 'Penang',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/celeron_g3900_cpu_1775291202_963bd515_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $seller2->id,
            'title'       => 'Intel Pentium G3250 LGA1150 CPU',
            'category'    => 'Processor',
            'condition'   => 'Used - Good',
            'price'       => 45.00,
            'description' => 'Intel Pentium G3250 3.2GHz LGA1150. Dual-core budget processor. Great for very basic office or HTPC use.',
            'location'    => 'Johor',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/intel_pentium_g3250_lga1150_cp_1779031977_f4335ad9_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $user->id,
            'title'       => 'Intel CPU Cooler LGA1700 Socket (12th Gen Boxed)',
            'category'    => 'Cooling & Fans',
            'condition'   => 'New (Open Box)',
            'price'       => 55.00,
            'description' => 'Intel stock CPU cooler for LGA1700 socket (came with i5-12400F). Never used – upgraded to aftermarket. Mounting hardware included.',
            'location'    => 'Kuala Lumpur',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/intel_cpu_cooler_lga1700_socke_1780880603_cc520ac2_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $otherUser->id,
            'title'       => 'ASUS TUF Gaming Laptop – Like New',
            'category'    => 'Laptop',
            'condition'   => 'Used - Like New',
            'price'       => 3200.00,
            'description' => 'ASUS TUF Gaming laptop in excellent condition. Barely used. Full specs available on request. Comes with original charger and box.',
            'location'    => 'Kuala Lumpur',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/asus_tuf_gaming_like_new_1780877795_c79aa926_progressive_thumbnail.jpg',
        ]);

        MarketplaceListing::create([
            'user_id'     => $seller2->id,
            'title'       => 'Keychron K2 Pro White Edition Mechanical Keyboard',
            'category'    => 'Keyboard',
            'condition'   => 'Used - Like New',
            'price'       => 320.00,
            'description' => 'Keychron K2 Pro White Edition. Bluetooth + USB-C. Swappable switches. Lightly used, excellent condition.',
            'location'    => 'Selangor',
            'status'      => 'Active',
            'image_path'  => 'assets/marketplace-images/keychron_k2_pro_white_edition__1780906063_a0ba3387_progressive_thumbnail.jpg',
        ]);
    }
}
