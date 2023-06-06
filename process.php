<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    if(!empty($_POST['AAA'])){
        // loop to retrieve checked values
        foreach($_POST['AAA'] as $selected){
            echo $selected."</br>";
        }
    }
}
// Check if cities are selected
if (isset($_POST['cities'])) {
    $selectedCities = $_POST['cities'];
    $numCities = count($selectedCities);

    // Generate the SQL query to fetch distances for selected cities
    $placeholders = implode(',', array_fill(0, $numCities, '?'));
    $sql = "SELECT city, " . implode(', ', $selectedCities) . " FROM city_distances WHERE city IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters for the placeholders
    $stmt->bind_param(str_repeat('s', $numCities), ...$selectedCities);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Build the distance matrix
    $distanceMatrix = [];
    while ($row = $result->fetch_assoc()) {
        $city = $row['city'];
        unset($row['city']);
        $distanceMatrix[$city] = $row;
    }

    // Close the statement
    $stmt->close();

    // Solve the TSP using a brute-force approach
    $shortestPath = null;
    $shortestDistance = PHP_INT_MAX;

    function permute($cities, $start, $end, $currentPath = [], $currentDistance = 0)
    {
        global $distanceMatrix, $shortestPath, $shortestDistance;

        if ($start == $end) {
            $currentDistance += $distanceMatrix[end($cities)][reset($cities)];
            if ($currentDistance < $shortestDistance) {
                $shortestDistance = $currentDistance;
                $shortestPath = $currentPath;
            }
        } else {
            for ($i = $start; $i <= $end; $i++) {
                $cities = swap($cities, $start, $i);
                $currentPath[] = $cities[$start];
                permute($cities, $start + 1, $end, $currentPath, $currentDistance + $distanceMatrix[$cities[$start]][$cities[$start + 1]]);
                $cities = swap($cities, $start, $i);
                array_pop($currentPath);
            }
        }
    }

    function swap($cities, $i, $j)
    {
        $temp = $cities[$i];
        $cities[$i] = $cities[$j];
        $cities[$j] = $temp;
        return $cities;
    }

    permute($selectedCities, 0, $numCities - 1);

    // Display the shortest path and distance
    echo "Shortest Path: " . implode(' -> ', $shortestPath) . "<br>";
    echo "Shortest Distance: " . $shortestDistance;
} else {
    echo "No cities selected.";
}

// Close the database connection
$conn->close();

?>