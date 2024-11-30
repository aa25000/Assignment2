<?php 

//endpoint for the API
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

//get the response
$response = file_get_contents($url);
// decode the json to associative array
$data = json_decode($response, true);

// handle if there is no results
if (!isset($data["results"])) {
    die('There was an error fetching the data from the api');
}

//extract the data at the results
$result = $data["results"];

?>

<html>
    <head>
        <title>Student Statistics</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
        <style>
            body {
                padding: 2rem;
            }
            table {
                width: 100%;
                margin-top: 2rem;
            }
            th, td {
                text-align: center;
            }
            th {
                background-color: var(--primary);
                color: var(--background);
            }
        </style>
    </head>
    <body>
        <main>
            <h1>Student Statistics</h1>
            <p>University of Bahrain Students Enrollment by Nationality</p>
            
            <table>
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Programs</th>
                        <th>Nationality</th>
                        <th>College</th>
                        <th>Number of Students</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // loop through the results, display them in a table.
                    foreach($result as $res) {
                        ?>
                        <tr>
                            <td><?php echo $res["year"]; ?></td>
                            <td><?php echo $res["semester"]; ?></td>
                            <td><?php echo $res["the_programs"]; ?></td>
                            <td><?php echo $res["nationality"]; ?></td>
                            <td><?php echo $res["colleges"]; ?></td>
                            <td><?php echo $res["number_of_students"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </body>
</html>
