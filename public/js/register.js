
function register_controller($scope,$http,$q){

	var reg_interface = '/HHA-Web/AccountApi/signup';
	var details_interface = '/HHA-Web/AccountApi/ext/';
	//定义颜色
	var normal_color = '#8E8E8E';
	var warning_color = '#ff0000';
	var correct_color = '#00BB00';
	//各种正则表达式
	var password_pattern = /^\S{5,30}$/;
	var user_name_pattern = /^[\w\-\u4e00-\u9fa5]{5,30}$/;
	var real_name_pattern = /^[\w\-\u4e00-\u9fa5]{2,30}$/;
	var phone_pattern = /^[0-9]{5,15}$/;
	var email_pattern = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
	//定义各种输入框格式
	var input_normal = 'input-group';
	var input_correct = 'input-group has-success has-feedback';
	var input_wrong = 'input-group has-error has-feedback';

	/*0位置为用户名，1位置为密码，2位置为再次输入密码，*/
	$scope.input_reg_style = [null,null,null];
	/*定义各种输入内容，位置同上*/
	$scope.input_reg_content = [null,null,null];
	/*定义各种提示内容，位置同上*/
	var default_hint = ['请输入用户名','请输入密码','请再次输入密码'];
	$scope.input_reg_hint = ['请输入用户名','请输入密码','请再次输入密码'];
	/*定义各种提示内容的颜色，位置同上*/
	$scope.input_reg_hint_color = ['#8E8E8E','#8E8E8E','#8E8E8E'];
	/*定义各种输入是否成功*/
	var is_reg_success = [false,false,false];

	//定义各种输入框变化是响应事件，参数num为上述0，1，2等
	$scope.on_reg_change = function(num){
		if($scope.input_reg_content[num] == ''){
				$scope.input_reg_style[num] = input_wrong;
				//console.log($scope.input_reg_style[num]);
				$scope.input_reg_hint[num] = default_hint[num];
				$scope.input_reg_hint_color[num] = warning_color;
				//console.log($scope.input_reg_hint[num]);
				is_reg_success[num] = false;

				return;
		}
		switch(num){
			case 0:
				if(user_name_pattern.test($scope.input_reg_content[0])){
					$scope.input_reg_style[0] = input_correct;
					$scope.input_reg_hint[0] = '用户名格式正确';
					$scope.input_reg_hint_color[0] = correct_color;
					is_reg_success[0] = true;
				}else{
					$scope.input_reg_style[0] = input_wrong;
					$scope.input_reg_hint_color[0] = warning_color;
					is_reg_success[0] = false;
					if($scope.input_reg_content[0].length < 5){
						$scope.input_reg_hint[0] = '用户名应该大于等于5个字符';
					}else if($scope.input_reg_content[0].length > 30){
						$scope.input_reg_hint[0] = '用户名应该小于等于30个字符';
					}else{
						$scope.input_reg_hint[0] = '用户名只能包含数字,字母和汉字';
					}
				}
				break;
			case 1:
				if(password_pattern.test($scope.input_reg_content[1])){
					$scope.input_reg_style[1] = input_correct;
					$scope.input_reg_hint[1] = '密码格式正确';
					$scope.input_reg_hint_color[1] = correct_color;
					is_reg_success[1] = true;
				}else{
					$scope.input_reg_style[1] = input_wrong;
					$scope.input_reg_hint_color[1] = warning_color;
					is_reg_success[1] = false;
					if($scope.input_reg_content[1].length < 5){
						$scope.input_reg_hint[1] = '密码应该大于等于5个字符';
					}else if($scope.input_reg_content[1].length > 30){
						$scope.input_reg_hint[1] = '密码应该小于等于30个字符';
					}else{
						$scope.input_reg_hint[1] = '密码只能非空白字符';
					}
				}
				break;
			case 2:
				if(password_pattern.test($scope.input_reg_content[1]) == false){
					$scope.input_reg_style[2] = input_wrong;
					$scope.input_reg_hint[2] = '请将上一栏正确输入';
					$scope.input_reg_hint_color[2] = warning_color;
					is_reg_success[2] = false;
				}else if($scope.input_reg_content[1] != $scope.input_reg_content[2]){
					$scope.input_reg_style[2] = input_wrong;
					$scope.input_reg_hint[2] = '两次密码不同';
					$scope.input_reg_hint_color[2] = warning_color;
					is_reg_success[2] = false;
				}else{
					$scope.input_reg_style[2] = input_correct;
					$scope.input_reg_hint[2] = '再次输入密码正确';
					$scope.input_reg_hint_color[2] = correct_color;
					is_reg_success[2] = true;
				}
				break;
			default:
				//alert("default");
				break;
		}
	}
	
	//定义年月日变化响应函数
	var date_success = [false,false,false];

	$scope.reg_btn_types = ['btn-default','btn-default','btn-default'];
	$scope.reg_year = null;
	$scope.reg_month = null;
	$scope.reg_day = null;
	$scope.reg_years = new Array(120);
	$scope.reg_months = null;
	$scope.reg_days = null;
	$scope.reg_bir_hint = '';
	$scope.reg_bir_hint_color = normal_color;
	//得到当前年，月，日
	var myDate = new Date();
	var this_year = myDate.getFullYear();
	var this_month = myDate.getMonth() + 1;
	var this_day = myDate.getDate();
	//alert(this_day);
	for(var i=0;i<120;i++){
		$scope.reg_years[i] = this_year-i;
	};
	var temp_months = new Array(12);
	for(var i=0;i<12;i++){
		temp_months[i] = i+1;
	};
	var temp_days = new Array(31);
	for(var i=0;i<31;i++){
		temp_days[i] = i+1;
	};
	
	$scope.on_reg_year = function(num){
		$scope.reg_year = num;
		date_success[0] = true;
		date_success[1] = false;
		date_success[2] = false;
		$scope.reg_months = null;
		$scope.reg_days = null;
		$scope.reg_month = null;
		$scope.reg_day = null;
		$scope.reg_bir_hint = '请选择月份';
		$scope.reg_bir_hint_color = normal_color;
		$scope.reg_btn_types[0] = 'btn-success';
		$scope.reg_btn_types[1] = 'btn-default';
		$scope.reg_btn_types[2] = 'btn-default';
	}

	$scope.on_reg_month = function(num){
		
		if(date_success[0] == true){
			if(num > this_month && $scope.reg_year >= this_year){
				$scope.reg_month = '';
				date_success[1] = false;
				$scope.reg_days = null;
				$scope.reg_day = null;
				$scope.reg_bir_hint = '不能选择未来的月份';
				$scope.reg_bir_hint_color = warning_color;
				$scope.reg_btn_types[1] = 'btn-warning';
				return;
			}

			$scope.reg_month = num;
			date_success[1] = true;
			date_success[2] = false;
			$scope.reg_days = null;
			$scope.reg_day = null;
			$scope.reg_bir_hint = '请选择天数';
			$scope.reg_bir_hint_color = normal_color;
			$scope.reg_btn_types[1] = 'btn-success';
			$scope.reg_btn_types[2] = 'btn-default';
		}
	}

	//判断是否是闰年
	var is_leap_year = function(year){
		var y = Math.floor(year);
		if(y%4 != 0){
			return false;
		}else if(y%100 != 0){
			return true;
		}else if(y%400 == 0){
			return true;
		}else{
			return false;
		}
	}
	//计算年月对应天数
	var day_num = function(year,month){
		switch(month){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				return 31;
			case 4:
			case 6:
			case 9:
			case 11:
				return 30;
			case 2:
				if(is_leap_year(year)){
					return 29;
				}else{
					return 28;
				}
		}
	}

	$scope.on_reg_day = function(num){
		
		if(date_success[0] == true && date_success[1] == true){
			if(num > this_day && $scope.reg_year >= this_year && $scope.reg_month >= this_month){
				$scope.reg_day = '';
				$scope.reg_bir_hint = '不能选择未来的日期';
				$scope.reg_bir_hint_color = warning_color;
				date_success[2] = false;
				$scope.reg_btn_types[2] = 'btn-warning';
				return;
			}

			$scope.reg_day = num;
			$scope.reg_bir_hint = '成功选择生日';
			$scope.reg_bir_hint_color = correct_color;
			date_success[2] = true;
			$scope.reg_btn_types[2] = 'btn-success';
		}
	}

	$scope.on_reg_month_btn = function(){
		if(date_success[0] == false){
			$scope.reg_bir_hint = '请先选择年份';
			$scope.reg_bir_hint_color = warning_color;
			date_success[1] = false;
			$scope.reg_btn_types[0] = 'btn-warning';
		}else{
			$scope.reg_months = temp_months;
		}
	}

	$scope.on_reg_day_btn = function(){
		if(date_success[0] == false){
			$scope.reg_bir_hint = '请先选择年份';
			$scope.reg_bir_hint_color = warning_color;
			date_success[2] = false;
			$scope.reg_btn_types[0] = 'btn-warning';
		}else if(date_success[1] == false){
			$scope.reg_bir_hint = '请先选择月份';
			$scope.reg_bir_hint_color = warning_color;
			date_success[2] = false;
			$scope.reg_btn_types[1] = 'btn-warning';
		}else{
			var d = day_num($scope.reg_year,$scope.reg_month);
			$scope.reg_days = temp_days.slice(0,d);
		}
	}

	//以下顺序为真实姓名，手机号，电子邮箱
	$scope.reg_details_styles = [null,null,null]; 
	$scope.reg_details_contents = [null,null,null];
	var default_details_hint = ['请输入真实姓名','请输入电话/手机号码','请输入电子邮箱'];
	$scope.reg_details_hint = ['请输入真实姓名','请输入电话/手机号码','请输入电子邮箱'];
	$scope.reg_details_hint_color = ['#8E8E8E','#8E8E8E','#8E8E8E'];
	var is_details_success = [false,false,false];

	$scope.on_reg_details_change = function(num){
		if($scope.reg_details_contents[num] == ''){
				$scope.reg_details_styles[num] = input_normal;
				$scope.reg_details_hint_color[num] = normal_color;
				//console.log($scope.reg_details_styles[num]);
				$scope.reg_details_hint[num] = default_details_hint[num];
				//console.log($scope.reg_details_hint[num]);
				is_details_success[num] = false;
				//console.log(is_details_success[num]);
				return;
		}

		switch(num){
			case 0:
				if(real_name_pattern.test($scope.reg_details_contents[0])){
					$scope.reg_details_styles[0] = input_correct;
					$scope.reg_details_hint[0] = '真实姓名格式正确';
					$scope.reg_details_hint_color[0] = correct_color;
					is_details_success[0] = true;
				}else{
					$scope.reg_details_styles[0] = input_wrong;
					$scope.reg_details_hint_color[0] = warning_color;
					is_details_success[0] = false;
					if($scope.reg_details_contents[0].length < 2){
						$scope.reg_details_hint[0] = '真实姓名应该大于等于2个字符';
					}else if($scope.reg_details_contents[0].length > 30){
						$scope.reg_details_hint[0] = '真实姓名应该小于等于30个字符';
					}else{
						$scope.reg_details_hint[0] = '真实姓名只能包含数字,字母和汉字';
					}
				}
				break;
			case 1:
				if(phone_pattern.test($scope.reg_details_contents[1])){
					$scope.reg_details_styles[1] = input_correct;
					$scope.reg_details_hint[1] = '联系电话格式正确';
					$scope.reg_details_hint_color[1] = correct_color;
					is_details_success[1] = true;
				}else{
					$scope.reg_details_styles[1] = input_wrong;
					$scope.reg_details_hint_color[1] = warning_color;
					is_details_success[1] = false;
					if($scope.reg_details_contents[1].length < 5){
						$scope.reg_details_hint[1] = '联系电话应该大于等于5个字符';
					}else if($scope.reg_details_contents[1].length > 15){
						$scope.reg_details_hint[1] = '联系电话应该小于等于15个字符';
					}else{
						$scope.reg_details_hint[1] = '联系电话只能包含数字';
					}
				}
				break;
			case 2:
				if(email_pattern.test($scope.reg_details_contents[2])){
					$scope.reg_details_styles[2] = input_correct;
					$scope.reg_details_hint[2] = 'email格式正确';
					$scope.reg_details_hint_color[2] = correct_color;
					is_details_success[2] = true;
				}else{
					$scope.reg_details_styles[2] = input_wrong;
					$scope.reg_details_hint_color[2] = warning_color;
					is_details_success[2] = false;
					$scope.reg_details_hint[2] = 'email格式为xxx@xxx.xxx';
				}
				break;
			default:
				//alert("default");
				break;
		}
	}

	//用于用户名及密码通过后其他细节的填写
	var get_details = function(){
		var det = {
			'realname': '',
			'phone': '',
			'birthday': '',
			'sex': '',
			'email': ''
		};
		//真实姓名是否填写
		if(is_details_success[0] == true){
			det.realname = $scope.reg_details_contents[0];
		}
		//联系电话是否填写
		if(is_details_success[1] == true){
			det.phone = $scope.reg_details_contents[1];
		}
		//电子信箱是否填写
		if(is_details_success[2] == true){
			det.email = $scope.reg_details_contents[2];
		}
		//性别是否选择
		if($("#checkbox_man").is(':checked') == true){
			det.sex = 1;
		}else if($("#checkbox_woman").is(':checked') == true){
			det.sex = 0;
		}
		//生日是否选择
		if(date_success[0] && date_success[1] && date_success[2]){
			var bir = $scope.reg_year + '-';
			if($scope.reg_month < 10){
				bir += '0';
			}
			bir += $scope.reg_month;
			bir += '-';
			if($scope.reg_day < 10){
				bir += '0';
			}
			bir += $scope.reg_day;
			det.birthday = bir;
		}
		return det;
	}
	$scope.put_details = function(id){
		var defered = $q.defer();
		var u = details_interface + id;
		var det = get_details();
		//console.log(u);
		//console.log(det);

		$.post(u,det,function(result){
			console.log(result);
			if(result.ret == 0){
				alert("信息完善成功！");
			}else if(result.ret == -1){
				if(result.error == 601){
					alert("用户不存在！");
				}
				if(result.error == 602){
					alert("日期不合法！");
				}
				if(result.error == 603){
					alert("日期是未来的某一天！");
				}
				if(result.error == 100){
					alert("数据库异常！");
				}
				if(result.error == 601){
					alert("参数存在非法数据！");
				}
				if(result.error == 601){
					alert("未登陆！");
				}
				if(result.error == 601){
					alert("权限不足！");
				}
			}
		});

		return defered.promise;
	}
	$scope.on_reg_btn = function(){
		//alert(get_details().birthday);
		if(is_reg_success[0] && is_reg_success[1] && is_reg_success[2]){
			var defered = $q.defer();
			$.post(reg_interface,{
				'username': $scope.input_reg_content[0],
				'password': $scope.input_reg_content[1]
			},function(result){
				if(result.id == -1){
					console.log(result);
					var err_code = result.error;
					if(err_code == 501){
						alert('用户名已经存在');
					}else if(err_code == 102){
						alert('存在非法数据');
					}else if(err_code == 100){
						alert('数据库异常');
					}else{
						alert('未知错误');
					}
				}else{
					//to do something
					alert("注册成功！");
					//console.log(result);
					$scope.put_details(result.id);
				}
			});


			return defered.promise;
		}else{
			if(is_reg_success[0] == false){
				//console.log("请输入正确用户名");
				alert("请输入正确用户名");
			}else if(is_reg_success[1] == false){
				//console.log("请正确输入密码");
				alert("请正确输入密码");
			}else{
				//console.log("请正确填写再次输入密码一栏");
				alert("请正确填写再次输入密码一栏");
			}
		}

	}
};