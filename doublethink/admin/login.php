<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="css/admin-login.css">
    </head>
    <body id="page-login">
    <div class="login-container">
        <div class="login-box">
            <fieldset>
            <form method="post" action="login-action.php" id="loginForm" autocomplete="off">
                <div class="login-form">
                    <input name="form_key" type="hidden" value="VrvyrBVkmH1SY3Y2">
                    <h2>Login</h2>
                    <div id="messages">
                    </div>
                    <div class="input-box input-left"><label for="username">User Name:</label><br>
                        <input type="text" id="username" name="username" value="" class="required-entry input-text"></div>
                    <div class="input-box input-right"><label for="login">Password:</label><br>
                        <!-- This is a dummy hidden field to trick firefox from auto filling the password -->
                        <input type="text" class="input-text no-display" name="dummy" id="dummy">
                        <input type="password" id="password" name="password" class="required-entry input-text" value=""></div>
                    <div class="clear"></div>
                    <div class="form-buttons">
<!--                        <a class="left" href="https://www.fizik.com/index.php/admin/admin/index/forgotpassword/">Forgot your password?</a>-->
                        <input type="submit" class="form-button" value="Login" title="Login"></div>
                </div>
            </form>
                </fieldset>
            <div class="bottom"></div>
            <script type="text/javascript">
                var loginForm = new varienForm('loginForm');
            </script>
        </div>
    </div>
    </body>
</html>
