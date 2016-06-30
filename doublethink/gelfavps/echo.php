<?php
$url = $_GET['url'];
if(isset($url)) {
    echo file_get_contents($url);
}