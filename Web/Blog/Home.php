<div>
    
    <style>
        #corner {
            border-radius: 15px 50px 30px 5px;
            padding: 5px;
            width: 800px;
            height: 130px;
            background-color: gold;
            color: black;
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

    <div id="posts">
        <div ng-repeat="x in postData">
            <h2>{{x.title}} <small>{{x.author}}</small></h2><br/>
            <p ng-bind-html="x.body"></p>
            
            <footer><small>Posted on {{x.datePosted}}</small></footer>
            <hr style="border: 3px outset #595955;">
        </div>
    </div>
</div>