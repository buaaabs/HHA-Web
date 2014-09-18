<script src="js/login_controller.js"></script>
<div ng-controller = 'login_controller'>
<h2>欢迎登陆</h2>
<div class="form-group">
	<div class="{{input_style}}">
		<span class="input-group-addon">
			<i class="glyphicon glyphicon-user"></i>
		</span>

		<input type='text' name ='username' size =32 placeholder= "用户名/邮箱/手机"
			class = "form-control input-lg" required="autofocus" ng-model="user_name"
			ng-change="on_name_change()" >
		</input>
		<span class="{{span_style}}" style="margin-top:-25px;">
		</span>
	</div>
</div>

<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="glyphicon glyphicon-lock"></i>
		</span>
		<input type="password" id="password" ng-model="password" class="form-control input-lg" size="32" placeholder="密码" ng-change="on_password_change()"/>
	</div>
</div>
<div class="checkbox form-group">
	<label><input type="checkbox" id="isAutoLogin" name="isAutoLogin" ng-click="is_auto_login_change()"/>下次自动登陆</label>
	<label><font color="#FF0000">{{information}}</font></label>
</div>
<div class='form-group'>
	<button class="btn btn-primary btn-lg" ng-click="on_login()" >登陆</button>
	<button class="btn btn-default btn-lg" ng-click="on_reg_click()">注册</button>
	&nbsp;&nbsp;&nbsp;
	<a href="{{forget_password_url}}">忘记密码</a>
</div>

<div class="form-group">
	<label class="text-danger"></label>
</div>
</div>


	
