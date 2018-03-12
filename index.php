<?php
    if (!isset($_SESSION)) { session_start();}
    
?>
<html>
	<head>
        <meta name="viewport" content="width=device-width" />
        <title>Blog Bung</title>

        <!--CSS code -->
        <link rel="stylesheet" href="/Content/animation.css">
        <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
        <link rel="stylesheet" href="/Content/bootstrap.min.css">
        <link rel="stylesheet" href="/Content/index.css">

        <!--Scripts must be loaded in a specific order! -->
        <script type="text/javascript" src="/Scripts/jquery.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular.js"
                asp-fallback-src="/Scripts/angular.js"></script>
        <script type="text/javascript" src="/Scripts/angular-idle.min.js" asp-fall-sec="https://raw.githubusercontent.com/HackedByChinese/ng-idle/develop/angular-idle.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-animate.min.js"
                asp-fallback-src="/Scripts/angular-route.min.js"></script>
        <script src="https://unpkg.com/@uirouter/angularjs@1.0.15/release/angular-ui-router.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-route.min.js"
                asp-fallback-src="/Scripts/angular-animate.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-sanitize.js"
                asp-fallback-src="/Scripts/angular-sanitize.js"></script>
        
        <!--BootStrap Code -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        
        <!-- Main Quill library -->
        <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>

        <!-- Theme included stylesheets -->
        <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
        
        <script src="/index.js"></script>
    </head>

	<body id="ic" ng-app ='index' ng-controller='indexController'>    
        <header style="padding: 10px; margin: 10px; font-size: 24px; font-family:Courier New, Courier, monospace">
            Collision Point
        </header>

        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" ng-click="changeState('Home', '')">Home</a></li>
                    <li class="nav-item"><a class="nav-link" ng-click="changeState('Resume', '')">Resume</a></li>
                    
                </ul>
                <?php
                    if(isset($_SESSION['logged'])){
                        echo "<li><a class=\"btn btn-outline-primary\" href=\"/index.php?createPost\"/>New Post</a></li>";
                    }
                ?>
                <form class="form-inline my-2 my-lg-0">
                    <input type="text" class="form-control mr-sm-2" placeholder="Search">
                    <button style="margin:10px;" type="submit" class="btn btn-outline-success my-2 my-sm-0">Submit</button>
                </form>
                <a href="https://www.facebook.com/brandon.ung.37?ref=br_rs"><img src="/Content/Images/facebook.png" style="margin:10px;width:25px;height:25px;" /></a>
                <a href="https://www.linkedin.com/in/brandon-ung-2286b0b0/"><img src="/Content/Images/linkedin.png" style="margin:10px;width:25px;height:25px;" /></a>
            </div>
        </nav>
            
        <div class="container">
            <div ui-view></div>
        </div>
    </body>
</html>

    <script>      
        function addPost() {
            var top = document.getElementById("createTitle").value;
            var bod = document.querySelector(".ql-editor").innerHTML;

            var dataPost = {
                action: 'createPost',
                topic: top,
                body: bod
            };
            
            //Make sure to JSON.stringify your data. Ajax will send an error message if the formatting is wrong.
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/Controllers/BlogController.php',
                data: dataPost,
                success: function (data) {
                    console.log(data);
                    if(data.Success == true){
                       window.location.href = "http://localhost/index.php";
                    }
                    else{
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        };
        
        function editPost(){
            var top = document.getElementById("editTitle").value;
            var bod = document.querySelector(".ql-editor").innerHTML;
            
            var dataPost = {
                action: 'editPost',
                topic: top,
                body: bod
            };
            
            //Make sure to JSON.stringify your data. Ajax will send an error message if the formatting is wrong.
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/Controllers/BlogController.php',
                data: dataPost,
                success: function (data) {
                    console.log(data);
                    if(data.Success == true){
                       window.location.href = "http://localhost/index.php";
                    }
                    else{
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        
        function createDescBox(){
            var container = document.getElementById('editor'); 
            console.log(container);
            var editor = new Quill(container, {
                        modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ['bold', 'italic', 'underline'],
                                ['code-block']
                            ]
                        },
                theme: 'snow'
            });
        }
</script>