<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$retailerLogos = [
    'TMT' => 'https://tmt.my/cdn/shop/files/tmt_logo_2022_512.png',
    'All IT Hypermarket' => 'https://www.allithypermarket.com.my/cdn/shop/files/All_IT_LOGO_070622-01.png',
    'Harvey Norman' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Harvey_Norman_logo.svg/512px-Harvey_Norman_logo.svg.png',
    'Apple Store' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
    'Switch' => 'https://switch.com.my/wp-content/uploads/2019/11/Switch_Logo_New_2018-01.png'
];

foreach($retailerLogos as $name => $url) {
    \App\Models\Retailer::where('name', $name)->update(['logo_path' => $url]);
}

$productImages = [
    'Graphics Card' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Processor' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Motherboard' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Memory' => 'https://images.unsplash.com/photo-1562976540-1502f714426d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Storage' => 'https://images.unsplash.com/photo-1597849065274-123456789abc?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Smartphone' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Tablet' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Watch' => 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Laptop' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
    'Monitor' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
];

foreach($productImages as $category => $url) {
    \App\Models\Product::where('category', $category)->update(['image_path' => $url]);
}

// Fallback for any others
\App\Models\Product::whereNull('image_path')->update(['image_path' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80']);

echo "Updated images successfully.\n";
