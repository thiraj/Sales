<?php

$zip = new ZipArchive;

if ($zip->open('sales-laravel.7z') === TRUE) {
    $zip->extractTo('/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}

?>