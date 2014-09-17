<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="navbar-header">
        <div class="container">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a ng-click='on_home_click()' class="navbar-brand" href="#">HHA</a>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav pull-left">
                    <li class="{{navbar_choose[0]}}"><a ng-click='on_home_click()' href="#">Home</a>
                    </li>
                    <li class="{{navbar_choose[1]}}"><a ng-click='on_article_click()' href="#/article/">Article</a></li>
                    <li class="{{navbar_choose[2]}}"><a ng-click='on_introduce_click()' href="#/introduce/">Introduce</a></li>
                    <li class="{{navbar_choose[3]}}"><a ng-click='on_about_click()' href="#/about/">About</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="{{navbar_choose[4]}}"><a ng-click='on_login_click()' href="#/login/">Log In/Sign up</a></li>
                    <li class="{{navbar_choose[5]}}"><a ng-click='on_reg_click()' href="#/reg/">register</a></li>
                </ul>
                
            </div>            
        </div>
    </div>
</div>
