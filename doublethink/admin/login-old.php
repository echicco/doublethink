<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>
    <body id="page-login">
        <form action="login-action.php" method="post">
            <div id="login-container">
                <div class="login-form">

                    <h2>Enter Credential</h2>
                        <div class="input-box input-left">
                            <label for="username">Username: </label><br>
                            <input type="text" name="username" id="username" value="" />
                        </div>
                        <div class="input-box input-right">
                            <label for="password">Password: </label><br>
                            <input type="password" name="password" id="password" value="" />
                        </div>
                        <div class="form-buttons">
                            <label for="remember">
                            <input type="checkbox" name="remember" id="remember" value="1" /> Remember me
                            </label>

                    <input type="submit" value="Submit" /> <input type="reset" value="Reset" />
                </div>
                </div>
            </div>

        </form>
    </body>
</html>
