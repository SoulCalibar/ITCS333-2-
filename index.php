<?php
$apiUrl = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';
$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    error_log("Error fetching data from API: " . error_get_last()['message']);
    die('An error occurred while retrieving data. Please try again later.');
}

$data = json_decode($response, true);

if ($data === NULL) {
    error_log("Error decoding JSON response: " . json_last_error_msg());
    die('An error occurred while processing the data. Please try again later.');
}

//Improved error handling and data validation
if (!isset($data['results'])) {
    error_log("Unexpected API response format.");
    die('An unexpected error occurred. Please try again later.');
}

$records = $data['results'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { direction: rtl; }
    </style>
</head>
<body>
    <div class="container">
        <h1>UOB Student Nationality Data</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>College</th>
                    <th>programe</th>
                    <th>Nationality</th>
                    <th>count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record['colleges']; ?></td>
                        <td><?php echo $record['the_programs']; ?></td>
                        <td><?php echo $record['ljnsy']; ?></td>
                        <td><?php echo $record['number_of_students']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>