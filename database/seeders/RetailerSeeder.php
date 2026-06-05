<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Retailer;

class RetailerSeeder extends Seeder
{
    public function run(): void
    {
        Retailer::create([
            'name' => 'TMT',
            'website_url' => 'https://www.tmt.my',
            'logo_path' => asset('storage/logos/download (14).png'),
            'location' => 'Mid Valley Megamall, KL',
            'latitude' => 3.1187,
            'longitude' => 101.6775
        ]);

        Retailer::create([
            'name' => 'All IT Hypermarket',
            'website_url' => 'https://www.allithypermarket.com.my',
            'logo_path' => asset('storage/logos/all it hypermarket.png'),
            'location' => 'Low Yat Plaza, KL',
            'latitude' => 3.1439,
            'longitude' => 101.7100
        ]);

        Retailer::create([
            'name' => 'Harvey Norman',
            'website_url' => 'https://www.harveynorman.com.my',
            'logo_path' => asset('storage/logos/download (13).png'),
            'location' => 'Pavilion Bukit Jalil, KL',
            'latitude' => 3.0514,
            'longitude' => 101.6698
        ]);

        Retailer::create([
            'name' => 'Apple Store',
            'website_url' => 'https://www.apple.com/my/',
            'logo_path' => asset('storage/logos/images.jpg'),
            'location' => 'The Exchange TRX, KL',
            'latitude' => 3.1415,
            'longitude' => 101.7196
        ]);

        Retailer::create([
            'name' => 'Switch',
            'website_url' => 'https://switch.com.my',
            'logo_path' => asset('storage/logos/download (12).png'),
            'location' => 'Sunway Pyramid, Selangor',
            'latitude' => 3.0728,
            'longitude' => 101.6074
        ]);
    }
}
