<?php
define("FETCH_ID_LIST_MAX_LIMIT", 30);
define("FETCH_ID_LIST_DEFAULT_LIMIT", 10);

function fetch_id_list($conn, $limit, $filter_author, $filter_topic) {
    $list = array();
    // Limit the limit (duh!) to a reasonable number to prevent queries from becoming too expensive
    $limit = min($limit, FETCH_ID_LIST_MAX_LIMIT);

    $statement = $conn->prepare("SELECT id FROM posts WHERE author = COALESCE( ? , author) AND topic = COALESCE( ? , topic) ORDER BY id DESC LIMIT ?");
    $statement->bind_param('ssi', $filter_author, $filter_topic, $limit);
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
if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    exit;
}

// Ignore any request that doesn't have an 'action' parameter
if(!isset($_POST['action'])) {
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

$action = $_POST['action'];
$response = null;
switch($action) {
    case 'fetch-id-list':
        $limit = FETCH_ID_LIST_DEFAULT_LIMIT;
        if(isset($_POST['limit'])) {
            $limit = $_POST['limit'];
        }

        $filter_author = null;
        $filter_topic = null;   

        if(isset($_POST['author'])) {
            $filter_author = $_POST['author'];
        }
        if(isset($_POST['topic'])) {
            $filter_topic = $_POST['topic'];
        }

        $response = fetch_id_list($conn, $limit, $filter_author, $filter_topic);
        break;
    case 'fetch-post-data':
        if(!isset($_POST['ids'])) {
            break;
        }

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
?>