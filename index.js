angular.module("index", ['ngRoute', 'ngAnimate', 'ngSanitize', 'ui.router', 'ngIdle'])
.controller("indexController", ['$scope', '$route', '$routeParams', '$location', '$http', '$sce', '$state', '$window', 'authProvider',
function indexController($scope, $route, $routeParams, $location, $http, $sce, $state, $window, authProvider){
    this.$route = $route;
    this.$location = $location;
    this.$routeParams = $routeParams;
    
    $scope.user = null;
    $scope.logged = authProvider.isLoggedIn();
    
    //Login Credentials
    $scope.credentials = {
        'username': '',
        'password': '',
        'action': ''
    };
    
    $scope.login = function(){
        $window.alert("bye");
    }

    //Get post information from datbase...
    $scope.getPosts = function(){
        $window.alert('hello');
        
        $http({
            method: "POST",
            url: "/Controllers/BlogController.php",
            data: {
                action: "getPosts"
            },
            headers: {
                'Content-type': 'application/json'
            }
        }).then(function (response){//on success
            for(var i = 0; i < response.data.length ; i++){
                response.data.body = $sce.trustAsHtml(response.data.body);
            }
            $scope.postData = response.data;
            
        }, function(response){//on failure
            console.log(response.data,response.status);
        });
    };
    
    $scope.changeState = function(loc, param){
        $state.go(loc, param);
        
        if($state.current.authenticate && !authProvider.isLoggedIn()){
           redirectIfNotAuth();
        }
    };
    
    //Check if currentPage is accessible...
    function redirectIfNotAuth(){
        $state.go("Home", {});
    }
    
    //------------------------------------------------------------------
    
    //automatically converge to Homepage
    if($state.current.authenticate && !authProvider.isLoggedIn()){
       $location.path("/");
    }
    else{
        $scope.getPosts();
    }
    
}]).controller("resumeController", ['$scope', '$route', '$routeParams', '$location', '$http',                               
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
}])
.factory('authProvider', function() {
    var user = null;
    
      return {
        setUser : function(aUser){
          user = aUser;
        },
        isLoggedIn : function(){
          return(user)? user: false;
        },
        logOut : function(){
            user = null;
        }
      };
})
.config(['$stateProvider', '$urlRouterProvider', 'IdleProvider', 'KeepaliveProvider', function($stateProvider, $urlRouterProvider, IdleProvider, KeepaliveProvider){
    
    //Idle timer configuration
    IdleProvider.idle(900); //15 minutes
    IdleProvider.timeout(60);
    KeepaliveProvider.interval(600); //heartbeat every 10 minutes
    KeepaliveProvider.http('/'); // URL that makes sure session is alive
    
    $stateProvider
    .state('Home', {
        url: '/',
        templateUrl: '/Web/Blog/Home.php',
        controller: 'indexController',
        authenticate: false
    })
    .state('Login', {
        url: '/login',
        templateUrl: '/Web/Blog/Login.php',
        controller: 'indexController as lg',
        authenticate: false
    })
    .state('Resume', {
        url: '/resume',
        templateUrl: '/Web/Resume/myresume.php',
        authenticate: false
    })
    .state('CreatePost', {
        url: '/create',
        templateUrl: '/Web/Blog/postCreate.php',
        authenticate: true
    })
    .state('EditPost', {
        url: '/edit',
        templateUrl: '/Web/Blog/editPost.php',
        authenticate: true
    });
    
    $urlRouterProvider.otherwise("/");
}])
.run(['$rootScope', '$state', 'authProvider', 'Idle', function ($rootScope, $state,     authProvider, Idle) {
    
    //This will determine if a page is available to a user. If not, redirect them.
    $rootScope.$watch(function(){
            return $state.current.name;
        }, function(a){
           if($state.current.authenticate && !authProvider.isLoggedIn()){
              $state.go("Home", {});
              }
        });
    
    //This handles session timeouts.
    Idle.watch();
    $rootScope.$on('IdleStart', function(){
        //Begin countdown if user is idle.
    });
    $rootScope.$on('IdleTimeout', function(){
        authProvider.logOut();
    })
  }]);