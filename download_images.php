<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$images = [
    'NVIDIA GeForce RTX 4090 24GB' => 'https://m.media-amazon.com/images/I/71XN7d2-P1L._AC_SL1500_.jpg',
    'NVIDIA GeForce RTX 4070 Ti' => 'https://m.media-amazon.com/images/I/81x2yJ-Xy-L._AC_SL1500_.jpg',
    'Intel Core i9-14900K' => 'https://m.media-amazon.com/images/I/61gVbZ--U9L._AC_SL1500_.jpg',
    'AMD Ryzen 7 7800X3D' => 'https://m.media-amazon.com/images/I/610h2OiooIL._AC_SL1500_.jpg',
    'Apple iPad Pro 11-inch (M4)' => 'https://m.media-amazon.com/images/I/61EwB3uN2wL._AC_SL1500_.jpg',
    'Apple Mac mini (M2 Pro)' => 'https://m.media-amazon.com/images/I/51H-E68ZzRL._AC_SL1500_.jpg',
    'Apple iMac 24-inch (M3)' => 'https://m.media-amazon.com/images/I/71N14Ahn7yL._AC_SL1500_.jpg',
    'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz' => 'https://m.media-amazon.com/images/I/61jZzO127xL._AC_SL1500_.jpg',
    'ASUS ROG Strix Z790-E Gaming WiFi' => 'https://m.media-amazon.com/images/I/81X4I3l+RDL._AC_SL1500_.jpg',
    'Corsair RM850x 850W 80 Plus Gold' => 'https://m.media-amazon.com/images/I/71p1NW-D0-L._AC_SL1500_.jpg',
    'NZXT H5 Flow ATX Mid-Tower Case' => 'https://m.media-amazon.com/images/I/71a6eP9w-uL._AC_SL1500_.jpg',
    'Dell Alienware AW3423DWF QD-OLED' => 'https://m.media-amazon.com/images/I/71H2bVb3KjL._AC_SL1500_.jpg',
    'LG UltraGear 27GP850-B' => 'https://m.media-amazon.com/images/I/81IIfH2qBmL._AC_SL1500_.jpg',
    'Samsung 990 PRO 2TB PCIe 4.0 NVMe' => 'https://m.media-amazon.com/images/I/81b2HnI4nOL._AC_SL1500_.jpg',
    'Apple MacBook Pro 14-inch (M3 Pro)' => 'https://m.media-amazon.com/images/I/61Gj3Lw3eBL._AC_SL1500_.jpg',
    'Apple Studio Display' => 'https://m.media-amazon.com/images/I/71R1vLh+CqL._AC_SL1500_.jpg'
];

$marketplaceImages = [
    'https://m.media-amazon.com/images/I/71XN7d2-P1L._AC_SL1500_.jpg',
    'https://m.media-amazon.com/images/I/61gVbZ--U9L._AC_SL1500_.jpg',
    'https://m.media-amazon.com/images/I/61jZzO127xL._AC_SL1500_.jpg',
    'https://m.media-amazon.com/images/I/71p1NW-D0-L._AC_SL1500_.jpg'
];

$context = stream_context_create([
    "http" => [
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    ]
]);

if (!is_dir(storage_path('app/public/products'))) {
    mkdir(storage_path('app/public/products'), 0755, true);
}

foreach(\App\Models\Product::all() as $product) {
    if (isset($images[$product->name])) {
        $url = $images[$product->name];
        $filename = 'products/' . md5($product->name) . '.jpg';
        $path = storage_path('app/public/' . $filename);
        
        $imgData = @file_get_contents($url, false, $context);
        if ($imgData) {
            file_put_contents($path, $imgData);
            $product->image_path = $filename;
            $product->save();
            echo "Downloaded and saved for {$product->name}\n";
        } else {
            echo "Failed to download for {$product->name}\n";
        }
    }
}

foreach(\App\Models\MarketplaceListing::all() as $i => $item) {
    $url = $marketplaceImages[$i % count($marketplaceImages)];
    $filename = 'marketplace/' . md5($url . $i) . '.jpg';
    $path = storage_path('app/public/' . $filename);
    
    if (!is_dir(storage_path('app/public/marketplace'))) {
        mkdir(storage_path('app/public/marketplace'), 0755, true);
    }
    
    $imgData = @file_get_contents($url, false, $context);
    if ($imgData) {
        file_put_contents($path, $imgData);
        $item->image_path = $filename;
        $item->save();
        echo "Downloaded marketplace item $i\n";
    }
}

echo "All done!\n";
