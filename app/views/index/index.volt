<div class="row clearfix">
	{{ partial("index/show-carousel") }}

	<div class="row clearfix">
		<div class="col-md-7 column">
			{{ image('image/world.jpg','class':'img-responsive') }}
			{{ partial("index/about-modal") }}
		</div>
		<div id="login_div" class="col-md-5 column">
			{{ partial("index/login-form") }}
		</div>
	</div>
</div>

<div id="OpenWindow" class="center-block">
		<h1 class="register_logo">Registration <small>convenient and concise
</small></h1>
		<!-- <img src="res/welcome.jpg" alt="welcome" /> -->
		<form class="register_form" role="form" method="post" action="/HHA-Web/api/reg">
			<div class="form-group">
				<label for="exampleInputUserName">User Name</label><input type="text" class="form-control" id="exampleInputUserName" name="username" />
			</div>
			<div class="form-group">
				 <label for="register_InputPassword">Password</label><input type="password" class="form-control" id="register_InputPassword" name="password" />
			</div>
			<div class="form-group">
				 <label for="register_InputPassword2">Password Again</label><input type="password" class="form-control" id="register_InputPassword2" />
			</div>
			<button type="submit" class="btn btn-primary">Register</button>
		</form>
</div>

<script type="text/javascript">
	$().ready(function () {
		$("#register_btn").leanModal();
	});
</script>