<title>About Me</title>
        <!--CSS code -->
        <link rel="stylesheet" href="/Content/animation.css">
        <link rel="stylesheet" href="/Content/index.css">

        <div ng-app='index' style="padding:15px">
            <div class="page-header container-fluid" style="padding:10px;background-color:gold">
                <h1>Brandon Ung <small>  website information</small></h1>
                <h3>7648 Garvalia Ave. • Rosemead, CA 91770  • (626) 202-6423 • brandonung@ymail.com</h3>
            </div>

            <div ng-controller='resumeController' class="content">
                <ul class="nav nav-pills" style="padding-bottom: 20px">
                    <li role="presentation" ng-click="activeSwitch(1)" class={{tagOne}}>
                        <a><p>Home</p></a>
                    </li>
                    <li role="presentation" ng-click="activeSwitch(2)" class={{tagTwo}}>
                        <a><p>About Me</p></a>
                    </li>
                    <li role="presentation" ng-click="activeSwitch(3)" class={{tagThree}}>
                        <a><p>Education and Experiences</p></a>
                    </li>
                    <li role="presentation" ng-click="activeSwitch(4)" class={{tagFour}}>
                        <a><p>Projects</p></a>
                    </li>
                </ul>

                <div class="view-animate-container col-xs-20 col-md-50">
                    <div class="view-animate" ng-include="template.url"></div>
                </div>
            </div>
        </div>