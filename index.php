<?php
$apiUrl = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';
$response = file_get_contents($apiUrl);
if ($response === FALSE) {
    die('Error occurred while fetching data from the API');
}

$data = json_decode($response, true);

if ($data === NULL) {
    die('Error occurred while decoding JSON response');
}

echo '<pre>Raw JSON Response:<br>';
echo $response;
echo '</pre>';

echo '<pre>Decoded JSON Array:<br>';
print_r($data);
echo '</pre>';

$records = $data['records'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>UOB Student Nationality Data</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.5/css/pico.min.css">
    <style>
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>UOB Student Nationality Data</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>College</th>
                        <th>Program</th>
                        <th>Nationality</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo $record['fields']['colleges']; ?></td>
                            <td><?php echo $record['fields']['the_programs']; ?></td>
                            <td><?php echo $record['fields']['nationalities']; ?></td>
                            <td><?php echo $record['fields']['count']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
