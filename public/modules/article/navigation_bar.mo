<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" >健康新闻</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <div class="col-lg-12">
            <div class="input-group">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-search"></span>
              </span>
              <input type="text" class="form-control" placeholder='文章/图片/视频' id="in">
              <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{{search_type}}<span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                  <li ng-click="on_change_search_type('文章')" onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'">文章</li>
                  <li ng-click="on_change_search_type('图片')" onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'">图片</li>
                  <li ng-click="on_change_search_type('视频')" onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'">视频</li>
                </ul>
              </div>
            </div>
          </div>
          
        </div>
        <button type="submit" class="btn btn-default" ng-click="search()">搜索</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
