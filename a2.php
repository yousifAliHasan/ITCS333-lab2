<?php
// Task 1: Data Retrieval
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Initialize cURL
$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Check if response is valid
if ($response === false) {
    die('Error fetching data from API.');
}

// Decode the JSON response into a PHP associative array
$result = json_decode($response, true);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Bahrain Students Enrollment by Nationality</title>
    <link rel="stylesheet" href="https://unpkg.com/picocss/pico.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ffffff; /* white */
        }

        tbody tr:nth-child(odd) {
            background-color: #f7f7f7; /* Light grey */
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff; /* white */
        }

        @media (max-width: 600px) {
            th, td {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<main>
   <h1>University of Bahrain Students Enrollment by Nationality</h1>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Student Nationality</th>
                    <th>Number of Students</th>
                    <th>College</th>
                    <th>Program</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Task 2: Data Visualization
            if ($result && isset($result['results']) && count($result['results']) > 0) {
                foreach ($result['results'] as $record) {
                    $year = isset($record['year']) ? $record['year'] : 'N/A';
                    $semester = isset($record['semester']) ? $record['semester'] : 'N/A';
                    $nationality = isset($record['nationality']) ? $record['nationality'] : 'N/A';
                    $num_students = isset($record['number_of_students']) ? $record['number_of_students'] : 'N/A';
                    $college = isset($record['colleges']) ? $record['colleges'] : 'N/A';
                    $program = isset($record['the_programs']) ? $record['the_programs'] : 'N/A';

                    echo "<tr>";
                    echo "<td>" . $year . "</td>";
                    echo "<td>" . $semester . "</td>";
                    echo "<td>" . $nationality . "</td>";
                    echo "<td>" . $num_students . "</td>";
                    echo "<td>" . $college . "</td>";
                    echo "<td>" . $program . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data available.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
    <!-- End of assignment -->
</html>


