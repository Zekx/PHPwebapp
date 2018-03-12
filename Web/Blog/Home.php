<div id="homeView">
    
    <style>
        #corner {
            border-radius: 15px 50px 30px 5px;
            padding: 5px;
            width: 800px;
            height: 130px;
            background-color: gold;
            color: black;
        }
        
        div{
            float: left;
        }

    </style>

    <div style="padding:10px">
        <div id="corner">
            <h2>Welcome to my blogsite</h2>
            <h5>
                Hello there, I am Brandon Ung and I created this page dedicated to my own learning of web design and to post my own musings. I will generally post up topics like
                technology, food, restaurants, doodles and fun events I go to. Other information about me can be checked through my resume or other social media accounts as well.
            </h5>
        </div>

    </div>

    <div id="posts" style="width:80%">
        <div ng-repeat="x in postData track by $index">
            <div ng-if="x.removed != true">
                <h2>{{x.title}} <small> By: {{x.author}}</small></h2><br/>
                <p ng-bind-html="x.body"></p>

                <footer align="right"><small>Posted on {{x.datePosted}}</small> 
                <div ng-if="loggedIn != null">
                    <a href="/#!/editPost?id={{x.id}}" align="right">Edit</a> <a align="right">Remove</a>
                </div>
                </footer>
                <hr style="border: 3px outset #595955;">
            </div>
        </div>
    </div>
</div>

<script>
    function getPosts(){
            console.log("Retrieving Posts...");
                $.ajax({
                    method: "POST",
                    url: "../../Controllers/BlogController.php",
                    data: {
                        action: "getPosts"
                    },
                    dataType: "json",
                    success: function(data){   
                       
                       console.log(data); /*angular.element(document.getElementById('homeView')).scope().addPosts(data);
                        angular.element(document.getElementById('homeView')).scope().$apply();*/
                    },
                    error: function(xhr, status, error){
                        console.log(xhr.responseText);
                    }
                })
            };
    $(document).ready(function() {
        //getPosts();
    });
    
</script>