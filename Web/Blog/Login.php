<?php
    if (!isset($_SESSION)) { session_start();}
?>

<div style="padding-left:20px;border:solid;width:500px;height:400px;position:relative;left:30px">
    <h2>Admin Login</h2>

    <?php    
        echo "<h2 style=\"color:red\">" . $_SESSION['error'] . "</h2>";
    
        if(!isset($_SESSION['logged'])){
            echo "<form id=\"loginForm\" action=\"/Controllers/BlogController.php\" method=\"post\">";
            echo    "<input type=\"hidden\" name=\"action\" value=\"login\">";
            
            echo    "<h3>Username</h3>";

            echo    "<input name=\"username\" type=\"text\" class=\"form-control input-sm\" style=\"width:300px\"/>";

            echo    "<h3>Password</h3>";

            echo    "<input name=\"password\" type=\"password\" class=\"form-control input-sm\" style=\"width:300px\" /> <br/>";

            echo    "<input type=\"submit\" value=\"Login\" class=\"btn btn-secondary\" id=\"loginBtn\"/>";
            
            echo"</form>";
        }
        else{
            echo "<h2>You are already logged in " . $_SESSION['user'] . "!</h2>";
            echo "<form id=\"loginForm\" action=\"/Controllers/BlogController.php\" method=\"post\">";
            
            echo    "<input type=\"hidden\" name=\"action\" value=\"logout\">";
            
            echo    "<input type=\"submit\" value=\"Logout\" class=\"btn btn-secondary\" id=\"loginBtn\"/>";
            
            echo"</form>";
        }
    ?>
</div>