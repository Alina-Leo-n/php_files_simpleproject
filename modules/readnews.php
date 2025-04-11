<?php
$news = [];
$files = scandir($_SERVER['DOCUMENT_ROOT'] . '/data');
foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data/' . $file);
    $news[] = unserialize($content);
}
?>