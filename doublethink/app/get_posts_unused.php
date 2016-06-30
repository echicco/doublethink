<?php
$link = mysqli_connect("127.0.0.1", "root", "", "doublethink");

if (!$link) {
    echo "Error: Unable to connect to database" . PHP_EOL;
//    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//
//
//echo "Success: A proper connection to the database was made." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
//echo '<br>';
//echo " " . "</br>";

$sql= "SELECT * FROM post";
$result = $link->query($sql);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $post[$row['id']] = array('author' => $row['name'], 'content' => $row['content'], 'topic' => $row['topic']);
}

echo json_encode($post);

mysqli_close($link);
?>