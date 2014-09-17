
function article_controller($scope,$sce){
	$scope.navigation_bar_url = 'modules/article/navigation_bar.mo';
	$scope.article_content_url = 'modules/article/article_content.mo';
	$scope.artilce_links_url = 'modules/article/other_links.mo';


	//定义关于文章的变量
	$scope.article_pri_title = '主标题'; //文章主标题
	$scope.article_sub_title = '';  //文章副标题
	$scope.article_editor = '编辑';  //文章编辑
	$scope.article_date = '2014-08-26 19:58';  //文章日期，时间
	$scope.article_main = '<img src="images/Li.jpg"></img><p><center>11111111</center></p><img src="images/Li.jpg"></img><p><center>2222222</center></p><p>sdjfgsadjgfjadg</p><p>sadg23gfeegtqtysdagdsg</p>';  //文章主体


	//定义关于链接的变量
	$scope.others = [{cont: '2133215',url: '#'},
	{cont: '2133215',url: '#'},{cont: '2133215',url: '#'}
	,{cont: '2133215',url: '#'},{cont: '2133215',url: '#'}
	,{cont: '2133215',url: '#'}];

	//获得安全的html
	$scope.get_safe_article = function(text){
		return $sce.trustAsHtml(text);
	};

	//关于搜索
	$scope.search_type = '文章'; //搜索类型
	$scope.on_change_search_type = function(text){
		$scope.search_type = text;
	};
	//提交搜索的方法
	$scope.search = function(){
		//to do something
		alert("search "+$("#in").val()+" "+$scope.search_type);
	}
};






