<?php
function update_db($conn, $data) {
    foreach ($data as $tag) {
        $name = $tag['name'];
        $local = $tag['local'];
        $total = $tag['total'];
        echo($local);

        $statement = $conn->prepare("SELECT * FROM tags WHERE name = ?");
        $statement->bind_param('s', $name);
        $statement->execute();
        if($statement->fetch()) {
            $statement = $conn->prepare("UPDATE TABLE tags SET local = ?, total = ? WHERE name = ?");
            $statement->bind_param('i', $local);
            $statement->bind_param('i', $total);
            $statement->bind_param('s', $name);
            $statement->execute();
        }
        else {
            $statement = $conn->prepare("INSERT INTO tags VALUES(?, ?, ?)");
            $statement->bind_param('s', $name);
            $statement->bind_param('i', $local);
            $statement->bind_param('i', $total);
            $statement->execute();
        }
    }
};

$conn = new mysqli("localhost", "root", "", "gelfavps");
if($conn->connect_error) {
    exit;
}

$data = $_POST['data'];
if(isset($data)) {
    update_db($conn, json_decode($data, true));
}