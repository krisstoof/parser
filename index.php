<?php

require 'simple_html_dom.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$url = 'http://estoremedia.space/DataIT/';


$array = array(
    array(
        'title' => 'Title',
        'link'  => 'Link',
        'image' => 'Image',
        'price' => 'Price',
        'stars' => 'Stars',
        'amount'=> 'Amount'
    )
);
 
$filename = 'parseData.csv';
if(file_exists($filename)){
    unlink($filename);
}

// $list =$html->find('div.card > div.card-body > h4.card-title', 0);


$file = fopen($filename, 'w');
// header("Content-type:text/csv");
// header("Content-Disposition: attachment; filename=$filename");
// $output = fopen("php://output", "w");
// $header = array_keys($array[0]);
// $header = "title, link, image, price, stars, amount";
// $csv_handler = fopen($filename, 'w');
fputcsv($file, $array[0]);
// var_dump($list_array);
for($i = 1; $i <= 100; $i++){
    $html = file_get_html($url.'index.php?page='.$i);
    $list = $html->find('div.row', 0);
    $list_array = $list->find('div.col-lg-4');
    foreach($list_array as $element) {
        // $array['title'] = $element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->plaintext;
        $array['title'] = $element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->attr['data-name'];
        $array['link'] = '<a href="'.$url.$element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->href.'">'.$url.$element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->href.'</a>';
        $array['image'] = '<a href="'.$element->find('div.card > a > img.card-img-top',0)->src.'">'.$element->find('div.card > a >img.card-img-top',0)->src.'</a>';
        $array['price'] = $element->find('div.card > div.card-body > h5")',0)->children(1)->plaintext;
        // $array['description'] = $element->find('div.card > div.card-body > p.card-text")',0)->children(2)->plaintext;
        $result = explode('(', $element->find('div.card > div.card-footer > small")',0)->plaintext);
        $array['stars'] = $result[0];
        $array['amount'] = str_replace(')', '',$result[1]);
        
        fputcsv($file, $array);

        // print_r($array);
        // die;

    }

    // foreach($array as $el => $key) {
    //     fputcsv($file, $el);
    //     // echo $el;
    // }
    // print_r($list_array);

    fclose($file);
}