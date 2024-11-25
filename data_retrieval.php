<?php
// API endpoint URL
$apiUrl = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

// Fetch data from the API
$response = file_get_contents($apiUrl);

// Check if the API call was successful
if ($response === FALSE) {
    die('Error occurred while fetching data from the API');
}

// Decode the JSON response into a PHP array
$result = json_decode($response, true);

// Check if decoding was successful
if ($result === NULL) {
    die('Error occurred while decoding JSON response');
}

// Display the data (for demonstration purposes)
echo '<pre>';
print_r($result);
echo '</pre>';

?>
