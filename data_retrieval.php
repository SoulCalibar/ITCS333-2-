<?php
// API endpoint URL
$apiUrl = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';


$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as string
curl_setopt($ch, CURLOPT_HEADER, false); // Don't include headers


$response = curl_exec($ch);


if(curl_errno($ch)){
    $error_message = 'cURL Error (' . curl_errno($ch) . '): ' . curl_error($ch);
    die($error_message);
}


curl_close($ch);



if (empty($response)) {
    die('Error: API returned an empty response.');
}


$result = json_decode($response, true);

// Check if decoding was successful
if ($result === NULL) {
    $error_message = 'JSON Error: ' . json_last_error_msg();
    die($error_message);
}

if (!isset($result['results']) || empty($result['results'])) {
    die('Error: No data found in the API response.');
}


echo '<table>';
echo '<thead><tr>';
foreach ($result['results'][0] as $key => $value) {
    echo '<th>' . $key . '</th>';
}
echo '</tr></thead>';
echo '<tbody>';
foreach ($result['results'] as $row) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}
echo '</tbody></table>';

?>
