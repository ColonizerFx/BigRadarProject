<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$clearbitLogos = [
    'TMT' => 'https://logo.clearbit.com/tmt.my',
    'All IT Hypermarket' => 'https://logo.clearbit.com/allithypermarket.com.my',
    'Harvey Norman' => 'https://logo.clearbit.com/harveynorman.com.my',
    'Switch' => 'https://logo.clearbit.com/switch.com.my'
];

foreach($clearbitLogos as $name => $url) {
    \App\Models\Retailer::where('name', $name)->update(['logo_path' => $url]);
    echo "Updated logo path for: $name\n";
}
echo "Done.\n";
