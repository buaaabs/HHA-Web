<script src="js/index/carousel_controller.js"></script>
<div class="col-md-12 column" ng-controller='carousel_controller'>
	<div class="carousel slide" id="main-carousel" data-ride="carousel" 
	data-interval="3000">
		<ol class="carousel-indicators">
			<li data-slide-to="0" class="active">
			</li>
			<li data-slide-to="1" >
			</li>
			<li data-slide-to="2" >
			</li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img ng-src="{{pic_lp_url}}"></img>
				<div class="carousel-caption">
					<h4>
						First Thumbnail label
					</h4>
					<p>
						Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
					</p>
				</div>
			</div>
			<div class="item">
				<img ng-src="{{pic_lp_url}}"></img>
				<div class="carousel-caption">
					<h4>
						Second Thumbnail label
					</h4>
					<p>
						Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
					</p>
				</div>
			</div>
			<div class="item">
				<img ng-src="{{pic_lp_url}}"></img>
				<div class="carousel-caption">
					<h4>
						未来在我手中
					</h4>
					<p>
						我们是新兴的力量，我们将用我们自己的方式改变整个行业。
					</p>
				</div>
			</div>
		</div> 
		<a class="left carousel-control" ng-click="on_prev()"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a> 
		<a class="right carousel-control" ng-click="on_next()"><span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span></a>
	</div>