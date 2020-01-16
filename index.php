<?php
ini_set('error_reporting', E_ALL);
include 'simple_html_dom.php';


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

$file = fopen($filename, 'w');

for($i = 1; $i <= 1; $i++){
    $html = file_get_html($url.'index.php?page='.$i);
    $list = $html->find('div.row', 0);
    $list_array = $list->find('div.col-lg-4');
    foreach($list_array as $key => $element) {
        $key++;
        $array[$key]['title'] = $element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->attr['data-name'];
        $array[$key]['link'] = $url.$element->find('div.card > div.card-body > h4.card-title > a[data-name]',0)->href;
        $array[$key]['image'] = $element->find('div.card > a > img.card-img-top',0)->src;
        $array[$key]['price'] = $element->find('div.card > div.card-body > h5")',0)->children(1)->plaintext;
        // $array['description'] = $element->find('div.card > div.card-body > p.card-text")',0)->children(2)->plaintext;
        $result = explode('(', $element->find('div.card > div.card-footer > small")',0)->plaintext);
        $array[$key]['stars'] = substr_count($result[0], '&#9733;');
        $array[$key]['amount'] = str_replace(')', '',$result[1]);
        

    }
    
    foreach($array as $el) {
        fputcsv($file, $el, ';');
    }
}
echo 'Gotowe';


fclose($file);
