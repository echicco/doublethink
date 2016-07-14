<?php
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administrator page</title>
        <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>
    <body>
    <div class="header">
        <div class="header-right">
            <p class="login-data">
            Welcome <?php echo $_SESSION['admin_login']; ?> | <?php echo date("Y/m/d h:i:sa");?> | <a href="logout.php">Logout</a>
<!--                <input type="button" onclick="javascript:window.location.href='logout.php'" value="logout" />-->
            </p>
        </div>
    </div>
    <div class="middle">
        <?php if (isset($success)){ echo "<div>" . $success . "</div>";}?>
        <form action="insert.php" method="post">
            <div id="form">
            <h1>Insert a new quote</h1>
                <label for="author">Author: </label>
                <input type="text" name="author" id="author" />

                <label for="content">Content: </label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>

                <label for="topic">Topic: </label>
                <select name="topic" id="topic">
                    <option value="memes">Memes</option>
                    <option value="politica">Politica</option>
                    <option value="chiesa">Chiesa</option>
                </select>

                <label for="avatar_url">Avatar Url: </label>
                <input type="text" name="avatar_url" id="avatar_url" />

                <div class="submit"><input type="submit" value="Submit" /></div>
            </div>
        </form>
    </div>
    <div class=footer">
        <p class="login-data">Copyright Kappa - Igor 2016</p>
    </div>
    </body>
</html>