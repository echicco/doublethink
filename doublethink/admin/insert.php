<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "doublethink");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$author = mysqli_real_escape_string($link, $_POST['author']);
$content = mysqli_real_escape_string($link, $_POST['content']);
$topic = mysqli_real_escape_string($link, $_POST['topic']);
$avatar_url = mysqli_real_escape_string($link, $_POST['avatar_url']);

// attempt insert query execution
$sql = "INSERT INTO posts (author, content, topic, avatar_url) VALUES ('$author', '$content', '$topic', '$avatar_url')";
if(mysqli_query($link, $sql)){
    header("HTTP/1.1 303 See Other");
    header("Location: http://localhost/doublethink/doublethink/admin/index.php");
//    $success="Success";
} else{
    $success= 'Qualcosa è andato storto';
    $secondsWait = 1;
    header("Refresh:$secondsWait");
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);