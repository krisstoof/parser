<?php
ini_set('error_reporting', E_ALL);
include 'simple_html_dom.php';

if($_GET['id']){
        
    $id = ($_GET['id']);
}
$url = 'http://estoremedia.space/DataIT/';

// $csv = fopen('parseData.csv', 'r');

// // $data = fgetcsv($csv);

// echo '<table border="1">';
// while($data = fgetcsv($csv, 1000, ';')){
//     echo '<tr>';
//     foreach($data as $el) {
//         $arr = explode(',', $el);
//         foreach($arr as $element) {
//             echo '<td>';
//             if(strpos($element, 'http:') !== false) {
//                 // echo '<a href="'.$element.'">'.$element.'</a>';
//                 echo '<a href="/parser/product.php">'.$element.'</a>';
//             } else {
//                 echo htmlentities($element, ENT_QUOTES);
//             }
            
//             echo '</td>';
//         }
        
//     }
//     echo '</tr>';
// }
// echo '</table>';
// fclose($csv);
$array = array(
    'price' => 'Price',
    'price_old'  => 'Price Old',
    'image' => 'Image',
    'code' => 'Code',
    'stars' => 'Stars',
    'amount'=> 'Amount'
);
 
// $filename = 'parseData.csv';
// if(file_exists($filename)){
//     unlink($filename);
// }

// $file = fopen($filename, 'w');

$html = file_get_html($url.'index.php?product='.$id);
$list = $html->find('div.row', 0);
$list_array = $list->find('div.col-lg-9');
foreach($list_array as $element) {
    $array['price'] = $element->find('div.card > div.card-body > h5 > span.price")',0)->plaintext ? $element->find('div.card > div.card-body > h5 > span.price")',0)->plaintext : $element->find('div.card > div.card-body > h5 > span.price-promo")',0)->plaintext;
    $array['price_old'] = $element->find('div.card > div.card-body > h5 > del")',0)->plaintext;
    $array['image'] = $element->find('div.card > a > img.card-img-top',0)->src;
    $array['code'] = $element->find('div.card > div.card-body > h5")',0)->children(1)->plaintext;
    // $array['description'] = $element->find('div.card > div.card-body > p.card-text")',0)->children(2)->plaintext;
    $result = explode('(', $element->find('div.card > div.card-footer > small"',0)->plaintext);
    $array['stars'] = substr_count($result[0], '&#9733;');
    $array['amount'] = str_replace(')', '',$result[1]);
    
    print_r($array);
}

// foreach($array as $el) {
//     fputcsv($file, $el, ';');
// }
echo '<br>';
echo '<p>Gotowe</p>';
echo '<button onclick="back()">Wstecz</button>';
echo '<script>function back() {window.history.back()}</script>';



// // fclose($file);
