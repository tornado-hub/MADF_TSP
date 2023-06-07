<?php
$sourceCity = $_POST['source'];
$destinationCity = $_POST['destination'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Goa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch the city names and adjacency matrix from the database
$sql = "SELECT city FROM cities";
$result = $conn->query($sql);
$cities = array();
while ($row = $result->fetch_assoc()) {
    $cities[] = $row['city'];
}
$sql = "SELECT * FROM cities";
$result = $conn->query($sql);
$adjMatrix = array(); // Array to store adjacency matrix
$i = 0;
while ($row = $result->fetch_assoc()) {
    $x = array_values($row);
    array_shift($x);
    $adjMatrix[$i++] = $x;
}
for($i=0;$i<count($adjMatrix);$i++)
    for($j=0;$j<count($adjMatrix);$j++)
        if($adjMatrix[$i][$j]==0)
            $adjMatrix[$i][$j]=INF;

// Perform Dijkstra's algorithm to find the shortest path
$sourceIndex = array_search($sourceCity, $cities);
$destinationIndex = array_search($destinationCity, $cities);
dijkstra($adjMatrix, $sourceIndex, $destinationIndex, $cities);
$conn->close();

// Function to find the vertex with the minimum distance value
function minDistance($distances, $visited, $vertexCount) {
    $min = PHP_INT_MAX;
    $minIndex = -1;
    for ($v = 0; $v < $vertexCount; $v++) {
        if (!$visited[$v] && $distances[$v] <= $min) {
            $min = $distances[$v];
            $minIndex = $v;
        }
    }
    return $minIndex;
}
// Function to print the shortest path from source to destination
function printPath($parent, $destination, $cities) {
    if ($parent[$destination] === -1) {
        echo $cities[$destination];
        return;
    }
    printPath($parent, $parent[$destination], $cities);
    echo " -> " . $cities[$destination];
}
// Function to implement Dijkstra's algorithm
function dijkstra($graph, $source, $destination, $cities) {
    $vertexCount = count($graph);
    $distances = array_fill(0, $vertexCount, PHP_INT_MAX);
    $visited = array_fill(0, $vertexCount, false);
    $parent = array_fill(0, $vertexCount, -1);
    $distances[$source] = 0;
    for ($count = 0; $count < $vertexCount - 1; $count++) {
        $u = minDistance($distances, $visited, $vertexCount);
        $visited[$u] = true;

        for ($v = 0; $v < $vertexCount; $v++) {
            if (!$visited[$v] && $graph[$u][$v] !== 0 && $distances[$u] !== PHP_INT_MAX && $distances[$u] + $graph[$u][$v] < $distances[$v]) {
                $distances[$v] = $distances[$u] + $graph[$u][$v];
                $parent[$v] = $u;
            }
        }
    }
    echo "Shortest Path from : ";
    printPath($parent, $destination, $cities);
    echo "\n";
    echo "Shortest Distance: " . $distances[$destination]."km";
}
?>