<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cities";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if cities are selected
if (isset($_POST['cities'])) {
    $selectedCities = $_POST['cities'];
    $startingCity = $_POST['starting_city'];
    $numCities = count($selectedCities);

    // Generate the SQL query to fetch distances for selected cities
    $placeholders = implode(',', array_fill(0, $numCities, '?'));
    $sql = "SELECT city, " . implode(', ', $selectedCities) . " FROM citydist WHERE city IN ($placeholders)";
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
            $currentPath[] = $cities[$start];
            $currentDistance += calculatePathDistance($currentPath);
            // Add the distance from the last city back to the start city
            $currentDistance += $distanceMatrix[end($currentPath)][reset($currentPath)];
            if ($currentDistance < $shortestDistance) {
                $shortestDistance = $currentDistance;
                $shortestPath = $currentPath;
            }
        } else {
            for ($i = $start; $i <= $end; $i++) {
                $cities = swap($cities, $start, $i);
                $currentPath[] = $cities[$start];
                permute($cities, $start + 1, $end, $currentPath, $currentDistance);
                $cities = swap($cities, $start, $i);
                array_pop($currentPath);
            }
        }
    }
    
    function calculatePathDistance($path)
    {
        global $distanceMatrix;
        $distance = 0;
        $numCities = count($path);
        for ($i = 0; $i < $numCities - 1; $i++) {
            $currentCity = $path[$i];
            $nextCity = $path[$i + 1];
            $distance += $distanceMatrix[$currentCity][$nextCity];
        }
        return $distance;
    }
    
    // Rest of the code remains the same...
    

// Rest of the code remains the same...


    function swap($cities, $i, $j)
    {
        $temp = $cities[$i];
        $cities[$i] = $cities[$j];
        $cities[$j] = $temp;
        return $cities;
    }

    permute($selectedCities, 0, $numCities - 1);

    $startIndex = array_search($startingCity, $shortestPath);
    $shortestPath = array_merge(
        array_slice($shortestPath, $startIndex),
        array_slice($shortestPath, 0, $startIndex + 1) 
    );

    // Display the shortest path and distance
    echo "<h2>TSP Output</h2>";
    echo "<p>Starting City: " . $startingCity . "</p>";
    echo "<p>Shortest Path: " . implode(' -> ', $shortestPath) . "</p>";
    echo "<p>Shortest Distance: " . $shortestDistance . "</p>";

} else {
    echo "No cities selected.";
}

// Close the database connection
$conn->close();

?>