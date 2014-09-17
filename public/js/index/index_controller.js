//this is a controller of index page
function index_controller($scope,$window){
	

	//启动图片循环
	$scope.init_carousel = function(){
		$scope.$broadcast('start_carousel','1');
	}

}

