
<script src="js/register.js"></script>

<style type="text/css">
.ari{
  font-weight: lighter 
}
.bg{
  background-color: #ECF5FF
}

</style>
<div ng-controller="register_controller" class="bg">
  <form class="form-horizontal" role="form">
    <div class="form-group">  
      <label for="username" class="col-sm-4 control-label ari" >用户名</label>
        <div class="col-sm-4">
          <div class="{{input_reg_style[0]}}" style="width:100%;">
            <input type="text"  class="form-control" id="username" placeholder="用户名(5-30位字母,数字,汉字)" ng-change="on_reg_change(0)" ng-model="input_reg_content[0]">
          </div>
        </div>
      <label class="col-sm-4 ari"><span><font color="{{input_reg_hint_color[0]}}">{{input_reg_hint[0]}}</font></span></label>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-4 control-label ari">密码</label>
      <div class="col-sm-4">
        <div class="{{input_reg_style[1]}}" style="width:100%;">
            <input type="password" class="form-control" id="username" placeholder="密码(5-30位非空白字符)" ng-change="on_reg_change(1)" ng-model="input_reg_content[1]">
        </div>
      </div>
      <label class="col-sm-4 ari"><span><font color="{{input_reg_hint_color[1]}}">{{input_reg_hint[1]}}</font></span></label>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-4 control-label ari">确认密码</label>
      <div class="col-sm-4">
        <div class="{{input_reg_style[2]}}" style="width:100%;">
            <input type="password" class="form-control" id="username" placeholder="再次输入密码" ng-change="on_reg_change(2)" ng-model="input_reg_content[2]">
        </div>
      </div>
      <label class="col-sm-4 ari"><span><font color="{{input_reg_hint_color[2]}}">{{input_reg_hint[2]}}</font></span></label>
    </div>

    <div class="form-group">
      <span class="col-sm-offset-5 col-sm-2">以下内容为选填</span>
    </div>

    <div ng-include="reg_details_url"></div>
    
    <div class="form-group">
      <div class="col-sm-offset-5 col-sm-2">
        <button type="button" class="btn btn-success btn-lg" style=
        "font-size: 20px" ng-click="on_reg_btn()">立即注册</button>
      </div>
    </div>
  </form>
</div>
