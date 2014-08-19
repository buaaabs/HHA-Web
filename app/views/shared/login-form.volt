{{ form(login_url,"method": "post") }}
	<h2>欢迎登陆</h2>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="glyphicon glyphicon-user"></i>
			</span>
			{{ text_field("username","size":32,"placeholder":"用户名/邮箱/手机",
			"class":"form-control input-lg","required","autofocus" ) }}
		</div>
	</div>
	
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">
				<i class="glyphicon glyphicon-lock"></i>
			</span>
			{{ password_field("password","size":32,"placeholder":"密码",
			"class":"form-control input-lg","required") }}
		</div>
	</div>
	<div class="checkbox form-group">
		<label>{{ check_field("isAutoLogin") }} 下次自动登陆</label>
	</div>
	<div class='form-group'>
		{{ submit_button("登陆","class":"btn btn-lg btn-primary") }}
		<button class="btn btn-default btn-lg" >注册</button>
		&nbsp;&nbsp;&nbsp;
		{{ link_to('#','忘记密码') }}
	</div>

	<?php if (!isset($show_text))
		$show_text = ''; ?>

	<div class="form-group">
		<label class="text-danger">{{ show_text }}</label>
	</div>
	
{{end_form()}}
