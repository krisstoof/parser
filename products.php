<?php
ini_set('error_reporting', E_ALL);
include 'simple_html_dom.php';
// include 'product.php';
$csv = fopen('parseData.csv', 'r');

// $data = fgetcsv($csv);

echo '<table border="1">';
while($data = fgetcsv($csv, 1000, ';')){
    echo '<tr>';
    foreach($data as $el) {
        $arr = explode(',', $el);
        foreach($arr as $element) {
            echo '<td>';
            if(strpos($element, 'http:') !== false) {
                // echo '<a href="'.$element.'">'.$element.'</a>';
                echo '<a href="/parser/product.php?id='.substr($element, strrpos($element, '=' )+1).'">'.$element.'</a>';
            } else if (strpos($element, 'https:') !== false) {
                echo '<a href="'.$element.'">'.$element.'</a>';
            } else {
                echo htmlentities($element, ENT_QUOTES);
            }
            
            echo '</td>';
        }
        
    }
    echo '</tr>';
}
echo '</table>';
fclose($csv);