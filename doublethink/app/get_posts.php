<?php
function fetch_id_list($conn, $limit) {
    $list = array();

    $statement = $conn->prepare("SELECT id FROM posts ORDER BY id DESC LIMIT ?");
    $statement->bind_param('i', $limit);
    $statement->execute();

    $res = $statement->get_result();
    while($row = $res->fetch_row()) {
        array_push($list, $row[0]);
    }

    return $list;
}

function fetch_post_data($conn, $id) {
    $statement = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $statement->bind_param('i', $id);
    $statement->execute();

    if($res = $statement->get_result()) {
        return $res->fetch_assoc();
    }

    return array('error' => 'Unknown post ID');
}

function output_json($response) {
    echo json_encode($response);
}

// Skip non-POST requests since this page should only be used to deliver JSON
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
    exit;
}

$conn = new mysqli("localhost", "root", "", "doublethink");
if($conn->connect_error) {
    $response = array('error' => 'Unable to connect to the database.');
    output_json($response);
    exit;
}
if (!$conn->set_charset("utf8")) {
    $response = array('error' => 'Unable to set UTF-8 charset for the database.');
    output_json($response);
    exit;
}

$conn->set_charset('utf-8');

$action = $_POST['action'];
$response = null;
switch($action) {
    case 'fetch-id-list':
        $limit = $_POST['limit'];
        $response = fetch_id_list($conn, $limit);
        break;
    case 'fetch-post-data':
        $ids = $_POST['ids'];
        $response = array();
        foreach ($ids as $id) {
            array_push($response, fetch_post_data($conn, $id));
        }
        break;
    default:
        $response = array('error' => 'Invalid POST action.');
        break;
}

output_json($response);
$conn->close();

function filter_by($conn, $limit) {
    $list = array();

    $statement = $conn->prepare("SELECT id FROM posts WHERE author='Test' ORDER BY id DESC LIMIT ?");
    $statement->bind_param('i', $limit);
    $statement->execute();

    $res = $statement->get_result();
    while($row = $res->fetch_row()) {
        array_push($list, $row[0]);
    }

    return $list;

}
?>