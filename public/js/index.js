var routeApp = angular.module('route_app',['ngRoute']);

//设置安全路由
routeApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        templateUrl: 'app/views/index.html',
        controller: 'index_controller'
      }).
      when('/article',{
        templateUrl: 'app/views/article.html'
      }).
      when('/introduce',{
        templateUrl: 'app/views/introduce.html'
      }).
      when('/about',{
        templateUrl: 'app/views/about.html'
      }).
      when('/login',{
        templateUrl: 'app/views/login.html',
        controller: 'login_page_controller'
      }).
      when('/reg',{
        templateUrl: 'app/views/register.html'
      }).
      otherwise({
        redirectTo: '/'
      });
  }]);

  function route_controller($scope,$window){
    //to define some modules' URL
    $scope.about_modal_url = 'modules/index/about-modal.mo' ;
    $scope.show_carousel_url = 'modules/index/show-carousel.mo' ;
    $scope.foot_url = 'modules/shared/footer.mo';
    $scope.top_url = 'modules/index/top.mo';
    $scope.pic_world_url = 'images/world.jpg' ;
    $scope.pic_lp_url = 'images/lp.jpg' ;
    $scope.top_url = 'modules/shared/top.mo';
    $scope.login_form_url = 'modules/shared/login-form.mo' ;
    $scope.reg_url = 'modules/shared/register.mo';
    $scope.reg_details_url = 'modules/shared/reg_details.mo';




    $scope.navbar_choose = [0,0,0,0,0,0];

    var url = window.location.href;
    if(url == "https://localhost/HHA-Web/#/"){
      $scope.navbar_choose[0] = "active";
    }else if(url == "https://localhost/HHA-Web/#/article"){
      $scope.navbar_choose[1] = "active";
    }else if(url == "https://localhost/HHA-Web/#/introduce"){
      $scope.navbar_choose[2] = "active";
    }else if(url == "https://localhost/HHA-Web/#/about"){
      $scope.navbar_choose[3] = "active";
    }else if(url == "https://localhost/HHA-Web/#/login"){
      $scope.navbar_choose[4] = "active";
    }else{
      $scope.navbar_choose[5] = "active";
    }

    //用于自动登陆
    $scope.init = function(){
    var local_storage = $window.localStorage;
    var len = local_storage.length;
    //alert("first");
    if(len > 0){
      
        var name = local_storage.getItem("userName");
        var pass = local_storage.getItem("password");
        var user_info = {
          'userName': name,
          'password': pass
        };
      
        $scope.$broadcast('auto_login',user_info);
        //alert("second");
      }
    };
    /*$scope.$on('sb',function(e,msg){
      alert("sb is called");
      var session_storage = $window.sessionStorage;
      var len = session_storage.length;
      if(length > 0){
        alert(msg);
      }
    });*/



    //设置导航栏选中变黑
    $scope.on_article_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[1] = "active";
      $window.location.href = "#/article";
    };

    $scope.on_home_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[0] = "active";
      $window.location.href = "#";
    };

    $scope.on_introduce_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[2] = "active";
      $window.location.href = "#/introduce";
    };

    $scope.on_about_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[3] = "active";
      $window.location.href = "#/about";
    };

    $scope.on_login_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[4] = "active";
      $window.location.href = "#/login";
    };

    $scope.on_reg_click = function(){
      for(var i=0;i<$scope.navbar_choose.length;i++){
        $scope.navbar_choose[i] = 0;
      }
      $scope.navbar_choose[5] = "active";
      $window.location.href = "#/reg";
    };
  }