<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function downloadImageCurl($url, $savePath) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpcode >= 200 && $httpcode < 300 && $data) {
        file_put_contents(storage_path('app/public/' . $savePath), $data);
        return true;
    }
    return false;
}

$retailerLogos = [
    'TMT' => 'https://tmt.my/cdn/shop/files/tmt_logo_2022_512.png',
    'All IT Hypermarket' => 'https://www.allithypermarket.com.my/cdn/shop/files/All_IT_LOGO_070622-01.png',
    'Harvey Norman' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Harvey_Norman_logo.svg/512px-Harvey_Norman_logo.svg.png',
    'Switch' => 'https://switch.com.my/wp-content/uploads/2019/11/Switch_Logo_New_2018-01.png'
];

foreach($retailerLogos as $name => $url) {
    $filename = 'logos/' . md5($name) . '.png';
    if (downloadImageCurl($url, $filename)) {
        \App\Models\Retailer::where('name', $name)->update(['logo_path' => $filename]);
        echo "Downloaded logo via cURL: $name\n";
    } else {
        echo "Failed cURL logo: $name\n";
    }
}
echo "Done.\n";
