<?php
    if (!isset($_SESSION)) { session_start();}
?>

<html>
	<head>
        <meta name="viewport" content="width=device-width" />
        <title>Blog Bung</title>

        <!--CSS code -->
        <link rel="stylesheet" href="/Content/animation.css">
        <link rel="stylesheet" href="/Content/bootstrap.min.css">
        <link rel="stylesheet" href="/Content/index.css">

        <!--Scripts must be loaded in a specific order! -->
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular.js"
                asp-fallback-src="/Scripts/angular.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-animate.min.js"
                asp-fallback-src="/Scripts/angular-route.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-route.min.js"
                asp-fallback-src="/Scripts/angular-animate.min.js"></script>
        <script type="text/javascript"
                src="https://code.angularjs.org/1.6.5/angular-sanitize.js"
                asp-fallback-src="/Scripts/angular-sanitize.js"></script>
        <script type="text/javascript" src="/Scripts/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- Main Quill library -->
        <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>

        <!-- Theme included stylesheets -->
        <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
        
        <script src="index.js"></script>
    </head>

	<body ng-app ='index'>    
        <div id="homeView" ng-controller="indexController">
            <header style="padding: 10px; margin: 10px; font-size: 24px; font-family:Courier New, Courier, monospace">
                Collision Point
            </header>

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li onclick="switchPage(0)"><a>Home</a></li>
                            <li onclick="switchPage(1)"><a>Resume</a></li>
                        </ul>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>


                        <ul class="nav navbar-nav navbar-right">
                            <?php
                                if(isset($_SESSION['logged'])){
                                    echo "<li><a class=\"btn btn-info btn-sm\" data-toggle=\"modal\" data-target=\"#postModal\" />New Post</a></li>";
                                }
                            ?>
                            <li><a href="https://www.facebook.com/brandon.ung.37?ref=br_rs"><img src="/Content/Images/facebook.png" style="width:25px;height:25px;" /></a></li>
                            <li><a href="https://www.linkedin.com/in/brandon-ung-2286b0b0/"><img src="/Content/Images/linkedin.png" style="width:25px;height:25px;" /></a></li>
                        </ul>

                    </div>
                </div>
            </nav>
            
            <div ng-include="createView.url"></div>
            <div ng-include="currentView.url"></div>
        </div>
	</body>
    
    <script>
        function switchPage(val){
            angular.element(document.getElementById('homeView')).scope().changePage(val);
            if(val == 0){
                getPosts();   
            }
        }
        
        function getPosts(){
            console.log("Retrieving Posts...");
                $.ajax({
                    method: "POST",
                    url: "../Controllers/BlogController.php",
                    data: {
                        action: "getPosts"
                    },
                    dataType: "json",
                    success: function(data){                            
                        angular.element(document.getElementById('homeView')).scope().addPosts(data);
                        angular.element(document.getElementById('homeView')).scope().$apply();
                    },
                    error: function(xhr, status, error){
                        console.log(xhr.responseText);
                    }
                })
            }
        
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
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        };
        
         $(document).ready(function(){
               <?php
                    if($_SERVER['QUERY_STRING'] == "login"){
                        echo "switchPage(2);";
                        echo "getPosts();";
                    }
                        echo "getPosts();";
                ?>
               
               $('#postModal').on('shown.bs.modal', function () {
                    console.log("hello");

                    var container = document.getElementById('editor');
                    var editor = new Quill('container', {
                        modules: {
                            toolbar: [
                                [{ header: [1, 2, false] }],
                                ['bold', 'italic', 'underline'],
                                ['code-block']
                            ]
                        },
                        theme: 'snow'  // or 'bubble',
                    });
                })
            })
    </script>
</html>