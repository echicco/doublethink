<?php
include_once './db/db.php';

class itg_admin {
    
    static $abs_path;
    
    var $post = array();
    
    var $get = array();

    public function __construct() {
        session_start();

        //store the absolute script directory
        //note that this is not the admin directory
        self::$abs_path = dirname(dirname(__FILE__));

        //initialize the post variable
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->post = $_POST;
                array_walk_recursive($this->post, array($this, 'stripslash_gpc'));
        }

        //initialize the get variable
        $this->get = $_GET;
        //decode the url
        array_walk_recursive($this->get, array($this, 'urldecode'));
    }
    
    public function get_nicename() {
        $username = $_SESSION['admin_login'];
        global $db;
        $info = $db->get_row("SELECT `nicename` FROM `user` WHERE `username` = '" . $db->escape($username) . "'");
        if(is_object($info))
            return $info->nicename;
        else
            return '';
    }

    public function get_email() {
        $username = $_SESSION['admin_login'];
        global $db;
        $info = $db->get_row("SELECT `email` FROM `user` WHERE `username` = '" . $db->escape($username) . "'");
        if(is_object($info))
            return $info->email;
        else
            return '';
    }
    
    public function _authenticate() {
        //first check whether session is set or not
        if(!isset($_SESSION['admin_login'])) {
            //check the cookie
            if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
                //cookie found, is it really someone from the
                if($this->_check_db($_COOKIE['username'], $_COOKIE['password'])) {
                    $_SESSION['admin_login'] = $_COOKIE['username'];
                    header("location: index.php");
                    die();
                }
                else {
                    header("location: login.php");
                    die();
                }
            }
            else {
                header("location: login.php");
                die();
            }
        }
    }
    
    public function _login_action() {

        //insufficient data provided
        if(!isset($this->post['username']) || $this->post['username'] == '' || !isset($this->post['password']) || $this->post['password'] == '') {
            header ("location: login.php");
        }

        //get the username and password
        $username = $this->post['username'];
        $password = $this->post['password'];

        //check the database for username
        if($this->_check_db($username, $password)) {
            //ready to login
            $_SESSION['admin_login'] = $username;

            //check to see if remember, ie if cookie
            if(isset($this->post['remember'])) {
                //set the cookies for 1 day, ie, 1*24*60*60 secs
                //change it to something like 30*24*60*60 to remember user for 30 days
                setcookie('username', $username, time() + 1*24*60*60);
                setcookie('password', $password, time() + 1*24*60*60);
            } else {
                //destroy any previously set cookie
                setcookie('username', '', time() - 1*24*60*60);
                setcookie('password', '', time() - 1*24*60*60);
            }

            header("location: index.php");
        }
        else {
            header ("location: login.php");
        }

        die();
    }

    private function _check_db($username, $password) {
        global $db;
        $user_row = $db->get_row("SELECT * FROM `user` WHERE `username`='" . $db->escape($username) . "'");

        //general return
        if(is_object($user_row) && password_verify($password, ($user_row->password)))
            return true;
        else
            return false;
    }
    
    private function stripslash_gpc(&$value) {
        $value = stripslashes($value);
    }
    
    private function htmlspecialcarfy(&$value) {
        $value = htmlspecialchars($value);
    }
    
    protected function urldecode(&$value) {
        $value = urldecode($value);
    }
}