<?php
function fetch_id_list($limit) {
    $list = array();
    for($i = 0; $i < $limit; ++$i) {
        array_push($list, $i);
    }
    return $list;
}

function fetch_post_data($id) {
    $post = array(
        'id' => $id,
        'author' => 'Kevin Giovinazzo',
        'content' => 'Fieropa.com',
        'topic' => 'politica',
        'avatar_url' => 'https://scontent.xx.fbcdn.net/v/l/t1.0-9/13096140_594479124047932_3800282213437108589_n.jpg?oh=135e53245a06b47e00240e45d1b15f62&oe=57E64BFF',
        'date' => '16/07/1950'
    );
    return $post;
}

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    exit;
}

$action = $_POST['action'];
$response = null;
switch($action) {
    case 'fetch-id-list':
        $limit = $_POST['limit'];
        $response = fetch_id_list($limit);
        break;
    case 'fetch-post-data':
        $id = $_POST['id'];
        $response = fetch_post_data($id);
        break;
    default:
        $response = array('error' => 'Invalid POST action.');
        break;
}

echo json_encode($response);
?>