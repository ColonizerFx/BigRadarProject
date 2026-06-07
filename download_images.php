<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function downloadImage($url, $savePath) {
    $context = stream_context_create([
        "http" => [
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36\r\n" . 
                        "Accept: image/webp,image/apng,image/*,*/*;q=0.8\r\n"
        ]
    ]);
    
    $data = @file_get_contents($url, false, $context);
    if ($data !== false) {
        file_put_contents(storage_path('app/public/' . $savePath), $data);
        return true;
    }
    return false;
}

if (!is_dir(storage_path('app/public/products'))) mkdir(storage_path('app/public/products'), 0777, true);
if (!is_dir(storage_path('app/public/logos'))) mkdir(storage_path('app/public/logos'), 0777, true);

$productImages = [
    'NVIDIA GeForce RTX 4090 24GB' => 'https://m.media-amazon.com/images/I/71YyP9eT11L._AC_SX679_.jpg',
    'NVIDIA GeForce RTX 4070 Ti' => 'https://m.media-amazon.com/images/I/71X6QnOIfDL._AC_SX679_.jpg',
    'Intel Core i9-14900K' => 'https://m.media-amazon.com/images/I/61yD-K46m3L._AC_SX679_.jpg',
    'AMD Ryzen 7 7800X3D' => 'https://m.media-amazon.com/images/I/51rE8hZ+7BL._AC_SX679_.jpg',
    'Apple iPad Pro 11-inch (M4)' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/ipad-pro-11-select-wifi-spaceblack-202405?wid=940&hei=1112&fmt=png-alpha',
    'Apple Mac mini (M2 Pro)' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/mac-mini-hero-202301?wid=904&hei=840&fmt=jpeg',
    'Apple iMac 24-inch (M3)' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/imac-24-blue-selection-hero-202310?wid=904&hei=840&fmt=jpeg',
    'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz' => 'https://m.media-amazon.com/images/I/61qH+O6xKwL._AC_SX679_.jpg',
    'ASUS ROG Strix Z790-E Gaming WiFi' => 'https://m.media-amazon.com/images/I/81kHDBH2P0L._AC_SX679_.jpg',
    'Corsair RM850x 850W 80 Plus Gold' => 'https://m.media-amazon.com/images/I/71B9gDqK4ZL._AC_SX679_.jpg',
    'NZXT H5 Flow ATX Mid-Tower Case' => 'https://m.media-amazon.com/images/I/71gP-L1+xZL._AC_SX679_.jpg',
    'Dell Alienware AW3423DWF QD-OLED' => 'https://m.media-amazon.com/images/I/71N7xL1Qx6L._AC_SX679_.jpg',
    'LG UltraGear 27GP850-B' => 'https://m.media-amazon.com/images/I/81I-yP-gJ3L._AC_SX679_.jpg',
    'Samsung 990 PRO 2TB PCIe 4.0 NVMe' => 'https://m.media-amazon.com/images/I/81Y7y6O21XL._AC_SX679_.jpg',
    'Apple MacBook Pro 14-inch (M3 Pro)' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/mbp14-spaceblack-select-202310?wid=904&hei=840&fmt=jpeg',
    'Apple Studio Display' => 'https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/studio-display-gallery-1-202203?wid=3200&hei=2134&fmt=jpeg'
];

foreach($productImages as $name => $url) {
    $filename = 'products/' . md5($name) . '.jpg';
    if (downloadImage($url, $filename)) {
        \App\Models\Product::where('name', $name)->update(['image_path' => $filename]);
        echo "Downloaded product: $name\n";
    } else {
        echo "Failed product: $name\n";
    }
}

$retailerLogos = [
    'TMT' => 'https://tmt.my/cdn/shop/files/tmt_logo_2022_512.png',
    'All IT Hypermarket' => 'https://www.allithypermarket.com.my/cdn/shop/files/All_IT_LOGO_070622-01.png',
    'Harvey Norman' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Harvey_Norman_logo.svg/512px-Harvey_Norman_logo.svg.png',
    'Apple Store' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
    'Switch' => 'https://switch.com.my/wp-content/uploads/2019/11/Switch_Logo_New_2018-01.png'
];

foreach($retailerLogos as $name => $url) {
    $filename = 'logos/' . md5($name) . '.png';
    if (downloadImage($url, $filename)) {
        \App\Models\Retailer::where('name', $name)->update(['logo_path' => $filename]);
        echo "Downloaded logo: $name\n";
    } else {
        echo "Failed logo: $name\n";
    }
}

echo "Done.\n";
