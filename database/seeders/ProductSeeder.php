<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Retailer;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // GPUs
            [
                'name' => 'NVIDIA GeForce RTX 4090 24GB',
                'brand' => 'NVIDIA',
                'category' => 'Graphics Cards',
                'description' => 'The ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 8500.00,
                    'All IT Hypermarket' => 8450.00,
                    'Harvey Norman' => 8999.00
                ]
            ],
            [
                'name' => 'NVIDIA GeForce RTX 4070 Ti',
                'brand' => 'NVIDIA',
                'category' => 'Graphics Cards',
                'description' => 'Brilliant 1440p and 4K performance for serious gamers.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 3999.00,
                    'All IT Hypermarket' => 3899.00,
                ]
            ],
            // Processors
            [
                'name' => 'Intel Core i9-14900K',
                'brand' => 'Intel',
                'category' => 'Processors',
                'description' => '24 cores (8 P-cores + 16 E-cores) and 32 threads. Integrated Intel UHD Graphics 770 included.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 2850.00,
                    'All IT Hypermarket' => 2800.00,
                ]
            ],
            [
                'name' => 'AMD Ryzen 7 7800X3D',
                'brand' => 'AMD',
                'category' => 'Processors',
                'description' => '8 Cores, 16 Threads, featuring AMD 3D V-Cache Technology for massive gaming performance.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 1999.00,
                    'Harvey Norman' => 2100.00,
                ]
            ],
            // Apple Devices
            [
                'name' => 'Apple iPad Pro 11-inch (M4)',
                'brand' => 'Apple',
                'category' => 'Apple Devices',
                'description' => 'The ultimate iPad experience with the most advanced display, M4 chip, and superfast connectivity.',
                'image_path' => null,
                'prices' => [
                    'Apple Store' => 4499.00,
                    'Switch' => 4499.00,
                    'Harvey Norman' => 4550.00
                ]
            ],
            [
                'name' => 'Apple Mac mini (M2 Pro)',
                'brand' => 'Apple',
                'category' => 'Apple Devices',
                'description' => 'More muscle. More hustle. Mac mini with M2 Pro packs the speed you need to get more done faster.',
                'image_path' => null,
                'prices' => [
                    'Apple Store' => 5599.00,
                    'Switch' => 5549.00,
                ]
            ],
            [
                'name' => 'Apple iMac 24-inch (M3)',
                'brand' => 'Apple',
                'category' => 'Apple Devices',
                'description' => 'Brilliant 4.5K Retina display. Incredible M3 performance. Strikingly thin design.',
                'image_path' => null,
                'prices' => [
                    'Apple Store' => 6299.00,
                    'Switch' => 6299.00,
                ]
            ],
            // Memory
            [
                'name' => 'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz',
                'brand' => 'Corsair',
                'category' => 'Memory',
                'description' => 'Dynamic multi-zone RGB lighting. Optimized for Intel motherboards.',
                'image_path' => null,
                'prices' => [
                    'All IT Hypermarket' => 635.00,
                    'TMT' => 650.00,
                ]
            ],
            // Motherboards
            [
                'name' => 'ASUS ROG Strix Z790-E Gaming WiFi',
                'brand' => 'ASUS',
                'category' => 'Motherboards',
                'description' => 'Intel Z790 LGA 1700 ATX motherboard with 18+1 power stages, DDR5, and PCIe 5.0.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 2199.00,
                    'All IT Hypermarket' => 2150.00,
                ]
            ],
            // Power Supplies
            [
                'name' => 'Corsair RM850x 850W 80 Plus Gold',
                'brand' => 'Corsair',
                'category' => 'Power Supplies',
                'description' => 'Fully modular ATX power supply. 100% Japanese capacitors.',
                'image_path' => null,
                'prices' => [
                    'All IT Hypermarket' => 699.00,
                    'Harvey Norman' => 750.00,
                ]
            ],
            // Cases
            [
                'name' => 'NZXT H5 Flow ATX Mid-Tower Case',
                'brand' => 'NZXT',
                'category' => 'PC Cases',
                'description' => 'Perforated front panel for maximum cooling potential. Includes two pre-installed F120Q fans.',
                'image_path' => null,
                'prices' => [
                    'TMT' => 399.00,
                    'All IT Hypermarket' => 389.00,
                ]
            ],
            // More Monitors
            [
                'name' => 'Dell Alienware AW3423DWF QD-OLED',
                'brand' => 'Dell',
                'category' => 'Monitors',
                'description' => '34-inch QD-OLED gaming monitor with 165Hz refresh rate and 0.1ms response time.',
                'image_path' => null,
                'prices' => [
                    'Harvey Norman' => 5200.00,
                    'TMT' => 5100.00,
                ]
            ],
            [
                'name' => 'LG UltraGear 27GP850-B',
                'brand' => 'LG',
                'category' => 'Monitors',
                'description' => '27-inch QHD Nano IPS Gaming Monitor with 165Hz.',
                'image_path' => null,
                'prices' => [
                    'All IT Hypermarket' => 1550.00,
                    'TMT' => 1499.00,
                ]
            ],
            // More Storage
            [
                'name' => 'Samsung 990 PRO 2TB PCIe 4.0 NVMe',
                'brand' => 'Samsung',
                'category' => 'Storage',
                'description' => 'Blazing fast NVMe SSD with speeds up to 7450 MB/s.',
                'image_path' => null,
                'prices' => [
                    'All IT Hypermarket' => 850.00,
                    'TMT' => 840.00,
                ]
            ],
            // More Apple Devices
            [
                'name' => 'Apple MacBook Pro 14-inch (M3 Pro)',
                'brand' => 'Apple',
                'category' => 'Apple Devices',
                'description' => 'Mind-blowing. Head-turning. The new MacBook Pro with M3 Pro chip.',
                'image_path' => null,
                'prices' => [
                    'Apple Store' => 8999.00,
                    'Switch' => 8999.00,
                    'Harvey Norman' => 9100.00,
                ]
            ],
            [
                'name' => 'Apple Studio Display',
                'brand' => 'Apple',
                'category' => 'Apple Devices',
                'description' => 'A sight to be bold. 27-inch 5K Retina display.',
                'image_path' => null,
                'prices' => [
                    'Apple Store' => 6999.00,
                    'Switch' => 6999.00,
                ]
            ]
        ];

        foreach ($products as $pData) {
            $product = Product::create([
                'name' => $pData['name'],
                'brand' => $pData['brand'],
                'category' => $pData['category'],
                'description' => $pData['description'],
                'image_path' => $pData['image_path']
            ]);

            foreach ($pData['prices'] as $retailerName => $price) {
                $retailer = Retailer::where('name', $retailerName)->first();
                if ($retailer) {
                    $product->retailers()->attach($retailer->id, [
                        'price' => $price,
                        'product_url' => $retailer->website_url,
                        'availability_status' => 'In Stock'
                    ]);
                }
            }
        }
    }
}
