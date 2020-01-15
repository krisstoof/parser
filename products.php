<?php
ini_set('error_reporting', E_ALL);
include 'simple_html_dom.php';
$csv = fopen('parseData.csv', 'r');

// $data = fgetcsv($csv);

echo '<table border="1">';
while($data = fgetcsv($csv, 1000, ',')){
    echo '<tr>';
    foreach($data as $el) {
        $arr = explode(';', $el);
        foreach($arr as $element) {
            echo '<td>';
            echo htmlentities($element, ENT_QUOTES);
            echo '</td>';
        }
        
    }
    echo '</tr>';
}
echo '</table>';
fclose($csv);