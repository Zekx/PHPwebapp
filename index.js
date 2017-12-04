var index = angular.module("index", ['ngRoute', 'ngAnimate', 'ngSanitize']);

index.controller("indexController", ['$scope', '$route', '$routeParams', '$location', '$http', '$sce',
function indexController($scope, $route, $routeParams, $location, $http, $sce){
    this.$route = $route;
    this.$location = $location;
    this.$routeParams = $routeParams;
    
    $scope.view = [
        {name: 'homepage', url: "/Web/Blog/Home.php"},
        {name: 'resume', url: "/Web/Resume/ResumeLayout.php"},
        {name: 'login', url: "/Web/Blog/Login.php"}
    ];
    
    $scope.addPosts = function(data){
        for(var i = 0; i < data.length ; i++){
            data.body = $sce.trustAsHtml(data.body);
        }
        $scope.postData = data;
    };
    
    $scope.changePage = function (num){
        $scope.currentView = $scope.view[num];
        if(num == 0){
           $scope.addPosts($scope.postData);
        }
        $scope.$apply();
    };
    
    $scope.currentView = $scope.view[0];
}]);

index.controller("resumeController", ['$scope', '$route', '$routeParams', '$location', '$http',                               
    function resumeController($scope, $route, $routeParams, $location, $http) {
        
    this.$route = $route;
    this.$location = $location;
    this.$routeParams = $routeParams;
        
    $scope.tagOne = "active";
    $scope.tagTwo = "";
    $scope.tagThree = "";
    $scope.tagFour = "";
        
    $scope.templates = [
        { name: 'welcome', url: "/Web/Resume/welcome.html" },
        { name: 'aboutme', url: "/Web/Resume/aboutme.html" },
        { name: 'education', url: "/Web/Resume/education.html" },
        { name: 'projects', url: "/Web/Resume/projects.html" }
    ];

        $scope.activeSwitch = function (num) {
            if (num === 1) {
                $scope.tagOne = "active";
                $scope.tagTwo = "";
                $scope.tagThree = "";
                $scope.tagFour = "";

                $scope.template = $scope.templates[0];
            }
            if (num === 2) {
                $scope.tagOne = "";
                $scope.tagTwo = "active";
                $scope.tagThree = "";
                $scope.tagFour = "";

                $scope.template = $scope.templates[1];
            }
            if (num === 3) {
                $scope.tagOne = "";
                $scope.tagTwo = "";
                $scope.tagThree = "active";
                $scope.tagFour = "";

                $scope.template = $scope.templates[2];
            }
            if (num === 4) {
                $scope.tagOne = "";
                $scope.tagTwo = "";
                $scope.tagThree = "";
                $scope.tagFour = "active";

                $scope.template = $scope.templates[3];
            }
        };
    
    $scope.template = $scope.templates[0];
}]);