<?php
$html = '<html><body style="background:#fff;color:#000;">';
foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator('References/pictures')) as $file) {
    if ($file->isFile()) {
        $path = $file->getPathname();
        $url = str_replace('References\\pictures\\', '', $path);
        $url = str_replace('\\', '/', $url);
        // Copy to public to serve it easily
        $pubPath = 'public/temp_gallery/' . $url;
        @mkdir(dirname($pubPath), 0777, true);
        copy($path, $pubPath);
        $html .= '<div><h3>' . $url . '</h3><img src="/temp_gallery/' . $url . '" style="max-height:200px;"></div><hr>';
    }
}
$html .= '</body></html>';
file_put_contents('public/gallery.html', $html);
echo "Gallery generated!\n";
