<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$fallbackImages = [
    'NVIDIA GeForce RTX 4090 24GB' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'NVIDIA GeForce RTX 4070 Ti' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Intel Core i9-14900K' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'AMD Ryzen 7 7800X3D' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz' => 'https://images.unsplash.com/photo-1562976540-1502f714426d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'ASUS ROG Strix Z790-E Gaming WiFi' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Corsair RM850x 850W 80 Plus Gold' => 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'NZXT H5 Flow ATX Mid-Tower Case' => 'https://images.unsplash.com/photo-1555680202-c86f0e12f086?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Dell Alienware AW3423DWF QD-OLED' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'LG UltraGear 27GP850-B' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    'Samsung 990 PRO 2TB PCIe 4.0 NVMe' => 'https://images.unsplash.com/photo-1597849065274-123456789abc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
];

foreach($fallbackImages as $name => $url) {
    \App\Models\Product::where('name', $name)->update(['image_path' => $url]);
}

echo "Fallback images updated.\n";
