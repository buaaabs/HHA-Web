//the controller for login 
function login_controller($scope,$http,$q,$cookieStore){
	$scope.user_name = '';
	$scope.password = '';
	$scope.input_style = 'input-group';
	$scope.span_style = 'hidden';
	$scope.forget_password_url = '/index';
	$scope.information = null;

	var password_pattern = /^\w{6,10}$/;
	var user_name_pattern = /^\w{4,20}$/;
	var input_normal = 'input-group';
	var input_correct = 'input-group has-success has-feedback';
	var input_wrong = 'input-group has-error has-feedback';
	var span_correct = 'glyphicon glyphicon-ok form-control-feedback';
	var span_wrong = 'glyphicon glyphicon-remove form-control-feedback';
	var span_hidden = 'hidden';

	var reset_info = function(){
		if($scope.information != null){
			$scope.information = null;
		}		
	}

	//called when name changes
	$scope.on_name_change = function(){
		reset_info();
		if($scope.user_name==null){
			$scope.span_style = span_hidden;
			$scope.input_style = input_normal;
			return ;
		}
		if(user_name_pattern.test($scope.user_name)){
			$scope.input_style = input_correct;
			$scope.span_style = span_correct;
		} else {
			$scope.input_style = input_wrong;
			$scope.span_style = span_wrong;
		}
	}

	//called when password changes
	$scope.on_password_change = function(){
		reset_info();
	}

	var is_name_legal = function(){
		if(user_name_pattern.test($scope.user_name)){
			return true;
		}else {
			return false;
		}
	}

	var is_password_legal = function(){
		if(user_name_pattern.test($scope.password)){
			return true;
		}else {
			return false;
		}
	}

	var login_interface = '/HHA-Web/AccountApi/login';
	
	$scope.on_login = function(){
		//alert($scope.user_name+$scope.password);
		
		var isAutoLogin = document.getElementById("isAutoLogin");
		var can_auto_login = 'false';
		/*if(isAutoLogin.checked){
			if(! window.sessionStorage || ! window.localStorage){ 
	    		alert("您的浏览器不支持自动登录！"); 
			}else{
				can_auto_login = 'true';
			}
		}*/

		if(isAutoLogin.checked){
			can_auto_login = 'true';
		}
		
		if(is_password_legal() && is_name_legal()){
			//设置自动登录
			$cookieStore.put('userName',$scope.user_name);
			$cookieStore.put('password',$scope.password);
			//console.log(can_auto_login);
			$cookieStore.put('is_auto_login',can_auto_login);
			/*if(local_storage.getItem('is_auto_login') == 'false'){
				console.log("fffffffff");
			}else{
				console.log("ttttttttt");
			}*/

			//if(local_storage.length>0) alert("length is larger than 0");
			//$scope.$emit('sb',$scope.user_name);
			//do something 
			var defered = $q.defer();
			$.post(
				login_interface,
				{
					'username': $scope.user_name,
					'password': $scope.password
				},
				function (data){
					if(data.id == -1){
					var err_code = data.error;
					if(err_code == 401){
						$scope.information = '用户名不存在';
					}else if(err_code == 402){
						$scope.information = '密码错误';
					}else if(err_code == 100){
						$scope.information = '数据库异常';
					}else if(err_code == 102){
						$scope.information = '数据验证错误';
					}else{
						$scope.information = '用户名或密码错误';
					}
					//console.log($scope.information);
				}else{
					//to do something
					$cookieStore.put('id',data.id);
					$scope.information = '登陆成功';
					//console.log(data.id);
				}
				});
			return defered.promise;
			
			/*$http.post(login_interface,{
				'username': $scope.user_name,
				'password': $scope.password
			}).success(function(data){
				alert("success!" + data.id);
			}).error(function(data){
				alert("error!" + data.id);
			});*/
		}else{
			$scope.information = '用户名或密码格式错误';
		}
	}

	/*$scope.is_auto_login_change = function(){
		
		var isAutoLogin = document.getElementById("isAutoLogin");
		if(isAutoLogin.checked == true){
			$.cookie('is_auto_login','true');
		}else if(isAutoLogin.checked == false){
			$.cookie('is_auto_login','false');
		}
		console.log($.cookie('is_auto_login'));
	}*/

	$scope.is_auto_login_change = function(){
		
		var isAutoLogin = document.getElementById("isAutoLogin");
		if(isAutoLogin.checked == true){
			$cookieStore.put('is_auto_login','true');
		}else if(isAutoLogin.checked == false){
			$cookieStore.put('is_auto_login','false');
		}
		//$cookieStore.put('is_auto_login','true');
		//console.log($cookieStore.get('is_auto_login'));
	}

	$scope.$on('auto_login',function(event,msg){
		$scope.user_name = msg.userName;
		$scope.password = msg.password;
		var isAutoLogin = document.getElementById("isAutoLogin");
		if($cookieStore.get('is_auto_login') == 'true'){
			isAutoLogin.checked = true;
		}else{
			isAutoLogin.checked = false;
		}
		 
		$scope.on_login();
	});

}