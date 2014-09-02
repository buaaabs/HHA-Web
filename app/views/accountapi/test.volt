<header>
	<title>test</title>
</header>
<body>
	{{form("http://localhost:8888/HHA-Web/AccountApi/signup","method": "post")}}
		{{text_field('username')}}
		{{text_field('password')}}
		{{submit_button('sign up')}}
	</form>
</body>