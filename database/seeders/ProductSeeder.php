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
            // ─── AMD CPUs ───────────────────────────────────────────────────────
            [
                'name'        => 'AMD Ryzen 5 5600X',
                'brand'       => 'AMD',
                'category'    => 'Processor',
                'description' => 'Six-core, twelve-thread AMD Ryzen 5 5600X processor with Wraith Stealth cooler included. AM4 socket.',
                'image_path'  => 'assets/parts-images/6510779_sd.webp',
                'prices'      => ['TMT' => 669.00, 'All IT Hypermarket' => 649.00],
            ],
            [
                'name'        => 'AMD Ryzen 7 7700X',
                'brand'       => 'AMD',
                'category'    => 'Processor',
                'description' => 'Eight-core, sixteen-thread AMD Ryzen 7 7700X processor for AM5 platform. Blazing fast gaming performance.',
                'image_path'  => 'assets/parts-images/6519477cv11d.webp',
                'prices'      => ['TMT' => 1399.00, 'All IT Hypermarket' => 1349.00, 'Harvey Norman' => 1450.00],
            ],
            [
                'name'        => 'AMD Ryzen 5 7600X',
                'brand'       => 'AMD',
                'category'    => 'Processor',
                'description' => 'Six-core, twelve-thread AMD Ryzen 5 7600X for the AM5 platform. Efficient and fast for gaming builds.',
                'image_path'  => 'assets/parts-images/6519479cv11d.webp',
                'prices'      => ['TMT' => 999.00, 'All IT Hypermarket' => 979.00],
            ],

            // ─── Intel CPUs ─────────────────────────────────────────────────────
            [
                'name'        => 'Intel Core i7-9700',
                'brand'       => 'Intel',
                'category'    => 'Processor',
                'description' => '8-core, 8-thread Intel Core i7 9th Gen desktop processor. LGA1151 socket, 3.0GHz base clock.',
                'image_path'  => 'assets/parts-images/6347263_sd.webp',
                'prices'      => ['TMT' => 799.00, 'All IT Hypermarket' => 779.00],
            ],
            [
                'name'        => 'Intel Core i3-10100',
                'brand'       => 'Intel',
                'category'    => 'Processor',
                'description' => '4-core, 8-thread Intel Core i3 10th Gen processor. LGA1200 socket. Great value for budget builds.',
                'image_path'  => 'assets/parts-images/6411497_sd.webp',
                'prices'      => ['TMT' => 399.00, 'All IT Hypermarket' => 389.00],
            ],
            [
                'name'        => 'Intel Core i7-14700K',
                'brand'       => 'Intel',
                'category'    => 'Processor',
                'description' => '20-core (8P+12E), 28-thread unlocked Intel 14th Gen processor. LGA1700 socket. Excellent for gaming and content creation.',
                'image_path'  => 'assets/parts-images/6560420_sd.webp',
                'prices'      => ['TMT' => 2199.00, 'All IT Hypermarket' => 2149.00, 'Harvey Norman' => 2299.00],
            ],
            [
                'name'        => 'Intel Core Ultra 5 245',
                'brand'       => 'Intel',
                'category'    => 'Processor',
                'description' => 'Intel Core Ultra 5 Series 2 processor featuring Intel Arc Xe graphics. Next-gen AI performance.',
                'image_path'  => 'assets/parts-images/99dded4e-b909-4566-9ede-38c14f3dbeca.webp',
                'prices'      => ['TMT' => 1299.00, 'All IT Hypermarket' => 1249.00],
            ],

            // ─── NVIDIA GPUs ─────────────────────────────────────────────────────
            [
                'name'        => 'ASUS GeForce GT 1030 2GB',
                'brand'       => 'ASUS',
                'category'    => 'Graphics Card',
                'description' => 'ASUS GeForce GT 1030 2GB GDDR5. Silent 0dB fan technology. Low-profile form factor.',
                'image_path'  => 'assets/parts-images/1bff2602-9413-45c4-af0f-4ae795f48091.webp',
                'prices'      => ['TMT' => 399.00, 'All IT Hypermarket' => 389.00],
            ],
            [
                'name'        => 'ASUS Dual GeForce RTX 4060',
                'brand'       => 'ASUS',
                'category'    => 'Graphics Card',
                'description' => 'ASUS Dual GeForce RTX 4060 8GB GDDR6. Dual Axial-tech fans. Ada Lovelace architecture.',
                'image_path'  => 'assets/parts-images/643e9310-71fe-45ae-a4bc-2ec91ad6522d.webp',
                'prices'      => ['TMT' => 1699.00, 'All IT Hypermarket' => 1649.00, 'Harvey Norman' => 1750.00],
            ],
            [
                'name'        => 'PNY GeForce RTX 4060 Ti 8GB',
                'brand'       => 'PNY',
                'category'    => 'Graphics Card',
                'description' => 'PNY GeForce RTX 4060 Ti 8GB GDDR6. Dual-fan cooling. DLSS 3 and Ray Tracing support.',
                'image_path'  => 'assets/parts-images/9690eca9-a815-4622-a275-9e3bd100f833.webp',
                'prices'      => ['TMT' => 2199.00, 'All IT Hypermarket' => 2149.00],
            ],
            [
                'name'        => 'NVIDIA GeForce RTX 3090 Founders Edition',
                'brand'       => 'NVIDIA',
                'category'    => 'Graphics Card',
                'description' => 'NVIDIA GeForce RTX 3090 24GB GDDR6X Founders Edition. The ultimate gaming and creative GPU.',
                'image_path'  => 'assets/parts-images/a4713530-fe3f-4f50-aab5-7c050031d24d.webp',
                'prices'      => ['TMT' => 3999.00, 'All IT Hypermarket' => 3850.00],
            ],
            [
                'name'        => 'ASUS GeForce GT 730 2GB (Silent)',
                'brand'       => 'ASUS',
                'category'    => 'Graphics Card',
                'description' => 'ASUS GeForce GT 730 2GB DDR3. Fanless silent design. Perfect for HTPC and light office use.',
                'image_path'  => 'assets/parts-images/bc49d6c5-1892-4db4-a53c-cffe94a543dd.webp',
                'prices'      => ['TMT' => 249.00, 'All IT Hypermarket' => 239.00],
            ],
            [
                'name'        => 'NVIDIA GeForce RTX 2080 Founders Edition',
                'brand'       => 'NVIDIA',
                'category'    => 'Graphics Card',
                'description' => 'NVIDIA GeForce RTX 2080 8GB GDDR6 Founders Edition. Turing architecture with real-time ray tracing.',
                'image_path'  => 'assets/parts-images/photo_6075886072840786727_y.jpg',
                'prices'      => ['TMT' => 2499.00, 'Harvey Norman' => 2599.00],
            ],

            // ─── Motherboards ────────────────────────────────────────────────────
            [
                'name'        => 'MSI MAG B660 Tomahawk WiFi DDR4',
                'brand'       => 'MSI',
                'category'    => 'Motherboard',
                'description' => 'MSI MAG B660 Tomahawk WiFi ATX motherboard for Intel 12th Gen. AMD B550 socket compatibility, DDR4.',
                'image_path'  => 'assets/parts-images/6504286_sd.webp',
                'prices'      => ['TMT' => 699.00, 'All IT Hypermarket' => 679.00],
            ],
            [
                'name'        => 'MSI PRO B650-P WiFi',
                'brand'       => 'MSI',
                'category'    => 'Motherboard',
                'description' => 'MSI PRO B650-P WiFi ATX motherboard for AMD Ryzen 7000 series. AM5 socket, PCIe 5.0 support.',
                'image_path'  => 'assets/parts-images/6528250_sd.webp',
                'prices'      => ['TMT' => 849.00, 'All IT Hypermarket' => 829.00, 'Harvey Norman' => 899.00],
            ],
            [
                'name'        => 'ASUS TUF Gaming Z790-Plus WiFi',
                'brand'       => 'ASUS',
                'category'    => 'Motherboard',
                'description' => 'ASUS TUF Gaming Z790-Plus WiFi ATX motherboard for Intel 12th/13th/14th Gen. LGA1700 socket.',
                'image_path'  => 'assets/parts-images/6571645_sd.webp',
                'prices'      => ['TMT' => 1499.00, 'All IT Hypermarket' => 1449.00, 'Harvey Norman' => 1550.00],
            ],
            [
                'name'        => 'Gigabyte B650 Eagle AX',
                'brand'       => 'Gigabyte',
                'category'    => 'Motherboard',
                'description' => 'Gigabyte B650 Eagle AX ATX motherboard for AMD Ryzen 7000 series. AM5 socket, WiFi 6E.',
                'image_path'  => 'assets/parts-images/6582206_sd.webp',
                'prices'      => ['TMT' => 799.00, 'All IT Hypermarket' => 769.00],
            ],
            [
                'name'        => 'MSI PRO B760-P WiFi DDR4',
                'brand'       => 'MSI',
                'category'    => 'Motherboard',
                'description' => 'MSI PRO B760-P WiFi DDR4 ATX motherboard for Intel 12th/13th/14th Gen. LGA1700 socket.',
                'image_path'  => 'assets/parts-images/0970fb59-28f8-4385-a62d-af4e9a598ab2.webp',
                'prices'      => ['TMT' => 649.00, 'All IT Hypermarket' => 629.00],
            ],
            [
                'name'        => 'ASUS ROG Strix X670E-E Gaming WiFi',
                'brand'       => 'ASUS',
                'category'    => 'Motherboard',
                'description' => 'ASUS ROG Strix X670E-E Gaming WiFi ATX motherboard. AM5, PCIe 5.0, DDR5, flagship gaming board.',
                'image_path'  => 'assets/parts-images/3298c3e2-703b-41b4-8352-1890a744f0b8.webp',
                'prices'      => ['TMT' => 2499.00, 'All IT Hypermarket' => 2399.00, 'Harvey Norman' => 2599.00],
            ],
            [
                'name'        => 'ASUS ROG Crosshair X670E Hero',
                'brand'       => 'ASUS',
                'category'    => 'Motherboard',
                'description' => 'ASUS ROG Crosshair X670E Hero ATX motherboard. AM5 socket, 18+2 power stages, PCIe 5.0.',
                'image_path'  => 'assets/parts-images/7410aaa4-e6b9-4462-b14b-1d3f52139e7a.webp',
                'prices'      => ['TMT' => 2999.00, 'Harvey Norman' => 3099.00],
            ],
            [
                'name'        => 'ASUS ROG Strix X670E-A Gaming WiFi (White)',
                'brand'       => 'ASUS',
                'category'    => 'Motherboard',
                'description' => 'ASUS ROG Strix X670E-A in stunning white finish. AM5 socket, WiFi 6E, PCIe 5.0 M.2 slots.',
                'image_path'  => 'assets/parts-images/7fba94b0-6853-48b0-8a2d-3f8cd43ee128.webp',
                'prices'      => ['TMT' => 2199.00, 'All IT Hypermarket' => 2149.00],
            ],
            [
                'name'        => 'ASUS TUF Gaming B650M-Plus WiFi',
                'brand'       => 'ASUS',
                'category'    => 'Motherboard',
                'description' => 'ASUS TUF Gaming B650M-Plus WiFi mATX motherboard. AM5 socket, DDR5, compact gaming form factor.',
                'image_path'  => 'assets/parts-images/f5960e0a-d7cd-4c0a-bbba-81f95cb3b703.webp',
                'prices'      => ['TMT' => 899.00, 'All IT Hypermarket' => 869.00],
            ],

            // ─── RAM Kits ────────────────────────────────────────────────────────
            [
                'name'        => 'Crucial 16GB DDR4 SO-DIMM 3200MHz',
                'brand'       => 'Crucial',
                'category'    => 'Memory',
                'description' => 'Crucial 16GB single stick DDR4 SO-DIMM for laptops and small form factor builds. 3200MHz CL22.',
                'image_path'  => 'assets/parts-images/33b91cec-0768-46d2-af6e-9331e5fa68fb.webp',
                'prices'      => ['TMT' => 149.00, 'All IT Hypermarket' => 139.00],
            ],
            [
                'name'        => 'OWC 8GB DDR3 1066MHz SO-DIMM Kit for Mac',
                'brand'       => 'OWC',
                'category'    => 'Memory',
                'description' => 'OWC 8GB (4x2GB) DDR3 1066MHz 204-pin SO-DIMM kit. Designed specifically for Apple Mac systems.',
                'image_path'  => 'assets/parts-images/8770e2c2-04b2-4dd2-9fc9-458b3e49b6de.webp',
                'prices'      => ['Switch' => 299.00, 'Apple Store' => 329.00],
            ],
            [
                'name'        => 'T-Create Expert DDR5 64GB (4x16GB) 6400MHz',
                'brand'       => 'TeamGroup',
                'category'    => 'Memory',
                'description' => 'T-Create Expert DDR5 64GB quad-channel kit. 6400MHz speed. Optimized for high-performance workstations.',
                'image_path'  => 'assets/parts-images/d14e7c55-ef17-43ff-b496-2af7f10fd3d4.webp',
                'prices'      => ['TMT' => 1099.00, 'All IT Hypermarket' => 1049.00],
            ],
            [
                'name'        => 'Crucial Pro 32GB (2x16GB) DDR4 3200MHz',
                'brand'       => 'Crucial',
                'category'    => 'Memory',
                'description' => 'Crucial Pro 32GB DDR4 3200MHz dual-channel kit. High-performance with heatspreader design.',
                'image_path'  => 'assets/parts-images/ed7f5fc1-1a8d-4a08-8f49-e932bdbdf0a1.webp',
                'prices'      => ['TMT' => 299.00, 'All IT Hypermarket' => 289.00, 'Harvey Norman' => 319.00],
            ],
            [
                'name'        => 'OWC 8GB DDR3 1066MHz DIMM Kit for Mac Pro',
                'brand'       => 'OWC',
                'category'    => 'Memory',
                'description' => 'OWC 8GB (4x2GB) DDR3 1066MHz 240-pin DIMM kit. Designed for Mac Pro desktop systems.',
                'image_path'  => 'assets/parts-images/f7e10516-f59c-4bde-850a-341beee17e0b.webp',
                'prices'      => ['Switch' => 249.00, 'Apple Store' => 279.00],
            ],

            // ─── Storage ─────────────────────────────────────────────────────────
            [
                'name'        => 'PNY CS900 1TB 2.5" SATA SSD',
                'brand'       => 'PNY',
                'category'    => 'Storage',
                'description' => 'PNY CS900 1TB 2.5" SATA III solid state drive. Up to 535 MB/s read speed. Perfect for OS and games.',
                'image_path'  => 'assets/parts-images/6385542cv11d.webp',
                'prices'      => ['TMT' => 249.00, 'All IT Hypermarket' => 239.00],
            ],
            [
                'name'        => 'WD Easystore 2TB External HDD',
                'brand'       => 'Western Digital',
                'category'    => 'Storage',
                'description' => 'WD Easystore 2TB USB 3.0 portable external hard drive. Compact design for on-the-go storage.',
                'image_path'  => 'assets/parts-images/6406513_sd.webp',
                'prices'      => ['Harvey Norman' => 399.00, 'TMT' => 379.00, 'All IT Hypermarket' => 369.00],
            ],
            [
                'name'        => 'Samsung 990 PRO 4TB PCIe 4.0 NVMe M.2',
                'brand'       => 'Samsung',
                'category'    => 'Storage',
                'description' => 'Samsung 990 PRO 4TB V-NAND NVMe SSD. Up to 7450 MB/s sequential read. PCIe 4.0 x4 interface.',
                'image_path'  => 'assets/parts-images/6559270_sd.webp',
                'prices'      => ['TMT' => 1599.00, 'All IT Hypermarket' => 1549.00, 'Harvey Norman' => 1650.00],
            ],
            [
                'name'        => 'Kingston NV3 500GB PCIe 4.0 NVMe M.2',
                'brand'       => 'Kingston',
                'category'    => 'Storage',
                'description' => 'Kingston NV3 500GB M.2 2280 NVMe SSD. PCIe 4.0 with up to 3500 MB/s read speed.',
                'image_path'  => 'assets/parts-images/3aff2076-8e11-4ceb-933b-f756ed660316.webp',
                'prices'      => ['TMT' => 169.00, 'All IT Hypermarket' => 159.00],
            ],
            [
                'name'        => 'WD Black SN770M 2TB PCIe 4.0 NVMe M.2',
                'brand'       => 'Western Digital',
                'category'    => 'Storage',
                'description' => 'WD Black SN770M 2TB compact M.2 2230 NVMe SSD. Ideal for handheld gaming devices and ultrabooks.',
                'image_path'  => 'assets/parts-images/756ef8f2-5974-4441-a53d-7b5f9e9016cc.webp',
                'prices'      => ['TMT' => 549.00, 'All IT Hypermarket' => 529.00],
            ],
            [
                'name'        => 'WD Blue 4TB 3.5" Desktop HDD',
                'brand'       => 'Western Digital',
                'category'    => 'Storage',
                'description' => 'WD Blue 4TB 3.5" SATA internal hard drive. 5400 RPM, 256MB cache. Reliable bulk storage.',
                'image_path'  => 'assets/parts-images/c199a36f-7abf-4b21-8756-94335cafea4d.webp',
                'prices'      => ['TMT' => 499.00, 'All IT Hypermarket' => 479.00, 'Harvey Norman' => 519.00],
            ],
            [
                'name'        => 'Seagate BarraCuda 8TB 3.5" Desktop HDD',
                'brand'       => 'Seagate',
                'category'    => 'Storage',
                'description' => 'Seagate BarraCuda 8TB 3.5" SATA HDD. 5400 RPM, 256MB cache. Ideal for high-capacity NAS and desktops.',
                'image_path'  => 'assets/parts-images/cebd47fc-5b56-4360-8d75-2058bccbe7cb.webp',
                'prices'      => ['TMT' => 849.00, 'All IT Hypermarket' => 829.00, 'Harvey Norman' => 879.00],
            ],
            [
                'name'        => 'Crucial P310 1TB PCIe Gen4 NVMe M.2 SSD',
                'brand'       => 'Crucial',
                'category'    => 'Storage',
                'description' => 'Crucial P310 1TB M.2 2280 NVMe SSD. PCIe Gen4 with up to 7100 MB/s read speed.',
                'image_path'  => 'assets/parts-images/e8979dd4-087e-4417-b342-6367e8e5d44f.webp',
                'prices'      => ['TMT' => 299.00, 'All IT Hypermarket' => 289.00],
            ],

            // ─── Power Supplies ──────────────────────────────────────────────────
            [
                'name'        => 'Thermaltake Toughpower GF A3 1080W',
                'brand'       => 'Thermaltake',
                'category'    => 'Power Supply',
                'description' => 'Thermaltake Toughpower GF A3 1080W fully modular ATX 3.1 PSU. 80 Plus Gold certified.',
                'image_path'  => 'assets/parts-images/6566259_sd.webp',
                'prices'      => ['TMT' => 899.00, 'All IT Hypermarket' => 869.00],
            ],
            [
                'name'        => 'Thermaltake Smart BM3 650W',
                'brand'       => 'Thermaltake',
                'category'    => 'Power Supply',
                'description' => 'Thermaltake Smart BM3 650W semi-modular ATX PSU. 80 Plus Bronze. Quiet 120mm fan.',
                'image_path'  => 'assets/parts-images/6569210_sd.webp',
                'prices'      => ['TMT' => 349.00, 'All IT Hypermarket' => 329.00],
            ],
            [
                'name'        => 'Corsair RM850e 850W Fully Modular',
                'brand'       => 'Corsair',
                'category'    => 'Power Supply',
                'description' => 'Corsair RM850e 850W fully modular ATX 3.0 PSU. 80 Plus Gold, ultra-quiet operation.',
                'image_path'  => 'assets/parts-images/a020d8ea-033f-45ec-8634-085cb0225c83.webp',
                'prices'      => ['TMT' => 599.00, 'All IT Hypermarket' => 579.00, 'Harvey Norman' => 629.00],
            ],
            [
                'name'        => 'MSI MAG A850GL PCIE5 850W',
                'brand'       => 'MSI',
                'category'    => 'Power Supply',
                'description' => 'MSI MAG A850GL PCIE5 850W fully modular ATX 3.1 PSU. 80 Plus Gold. Native PCIe 5.1 connector.',
                'image_path'  => 'assets/parts-images/b5a8d25a-71c6-46fa-8fcc-3ddf1dac1618.webp',
                'prices'      => ['TMT' => 649.00, 'All IT Hypermarket' => 629.00],
            ],
            [
                'name'        => 'Corsair RM1000x 1000W Fully Modular',
                'brand'       => 'Corsair',
                'category'    => 'Power Supply',
                'description' => 'Corsair RM1000x 1000W fully modular ATX PSU. 80 Plus Gold, Zero RPM fan mode.',
                'image_path'  => 'assets/parts-images/b97f494a-4f7e-41e9-964b-69d71c119044.webp',
                'prices'      => ['TMT' => 799.00, 'Harvey Norman' => 849.00, 'All IT Hypermarket' => 779.00],
            ],

            // ─── Apple Devices (Devices page) ────────────────────────────────────
            [
                'name'        => 'Apple MacBook Pro 14-inch (M3 Pro) Space Black',
                'brand'       => 'Apple',
                'category'    => 'Apple Devices',
                'description' => 'Apple MacBook Pro 14-inch with M3 Pro chip in Space Black. Stunning Liquid Retina XDR display.',
                'image_path'  => 'assets/parts-images/653a22d9-0889-442e-9f67-7ee03a92ffe5.webp',
                'prices'      => ['Apple Store' => 9499.00, 'Switch' => 9499.00, 'Harvey Norman' => 9699.00],
            ],
            [
                'name'        => 'Apple MacBook Air 13-inch (M2) Starlight',
                'brand'       => 'Apple',
                'category'    => 'Apple Devices',
                'description' => 'Apple MacBook Air 13-inch with M2 chip in Starlight. Fanless design, all-day battery life.',
                'image_path'  => 'assets/parts-images/6f4c4bef-6af3-40e2-b62e-b1396d2f6f8b.webp',
                'prices'      => ['Apple Store' => 5499.00, 'Switch' => 5499.00, 'Harvey Norman' => 5699.00],
            ],
            [
                'name'        => 'Apple MacBook Air 15-inch (M2) Midnight',
                'brand'       => 'Apple',
                'category'    => 'Apple Devices',
                'description' => 'Apple MacBook Air 15-inch with M2 chip in Midnight. Large Liquid Retina display with fanless design.',
                'image_path'  => 'assets/parts-images/776b4db3-e2f4-4412-b45c-99cbef911bd6.webp',
                'prices'      => ['Apple Store' => 6299.00, 'Switch' => 6299.00, 'Harvey Norman' => 6499.00],
            ],
        ];

        foreach ($products as $pData) {
            $product = Product::create([
                'name'        => $pData['name'],
                'brand'       => $pData['brand'],
                'category'    => $pData['category'],
                'description' => $pData['description'],
                'image_path'  => $pData['image_path'],
            ]);

            foreach ($pData['prices'] as $retailerName => $price) {
                $retailer = Retailer::where('name', $retailerName)->first();
                if ($retailer) {
                    $product->retailers()->attach($retailer->id, [
                        'price'               => $price,
                        'product_url'         => $retailer->website_url,
                        'availability_status' => 'In Stock',
                    ]);
                }
            }
        }
    }
}
