
function carousel_controller($scope){
	$scope.on_prev = function(){
		$('.carousel').carousel('prev'); 
	};
	$scope.on_next = function(){
		$('.carousel').carousel('next'); 
	};

	//页面加载时响应事件
	$scope.$on('start_carousel',function(event,msg){
		$('.carousel').carousel('cycle'); 
	});
}