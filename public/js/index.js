var routeApp = angular.module('route_app',['ngRoute','ngCookies']);

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

  function route_controller($scope,$window,$cookieStore){
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

    var temp_url = window.location.href;
    var url = temp_url.split('#')[1];
    //console.log(url);
    if(url == "/"){
      $scope.navbar_choose[0] = "active";
    }else if(url == "/article"){
      $scope.navbar_choose[1] = "active";
    }else if(url == "/introduce"){
      $scope.navbar_choose[2] = "active";
    }else if(url == "/about"){
      $scope.navbar_choose[3] = "active";
    }else if(url == "/login"){
      $scope.navbar_choose[4] = "active";
    }else{
      $scope.navbar_choose[5] = "active";
    }

    //用于自动登陆
    $scope.init = function(){
      if($cookieStore.get('is_auto_login') == 'true'){
        var name = $cookieStore.get("userName");
        var pass = $cookieStore.get("password");
        var user_info = {
          'userName': name,
          'password': pass
        };
      
        $scope.$broadcast('auto_login',user_info);
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