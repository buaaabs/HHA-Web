<link rel="stylesheet" type="text/css" href="bootstrap/iCheck/css/flat/green.css">
<script src="bootstrap/iCheck/icheck.min.js"></script>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
});
</script>
<div class="form-group">
  <label for="password" class="col-sm-4 control-label ari">性别</label>
  <div class="col-sm-4" style="margin-top:6px;">
    <input type="radio" name="iCheck" id="checkbox_man">男</input> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="iCheck" id="checkbox_woman">女</input> 
  </div>
  <label class="col-sm-4 ari"></label>
</div>

<div class="form-group">
  <label for="password" class="col-sm-4 control-label ari">生日</label>
  <div class="col-sm-4">
    <div class="input-group-btn" >
      <button type="button" class="btn {{reg_btn_types[0]}} dropdown-toggle" data-toggle="dropdown" style="width:100%;">{{reg_year}}年<span class="caret"></span></button>
      <ul class="dropdown-menu dropdown-menu" role="menu" style="height:120px;overflow:auto;">
        <li onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'" ng-repeat="year in reg_years track by $index" ng-click="on_reg_year(year)">{{year}}年</li>
        
      </ul>

    </div>
    <div class="input-group-btn" >
      <button type="button" class="btn {{reg_btn_types[1]}} dropdown-toggle" data-toggle="dropdown" style="width:100%;" ng-click="on_reg_month_btn()">{{reg_month}}月<span class="caret"></span></button>
     <ul class="dropdown-menu dropdown-menu" role="menu" style="  height:120px;overflow:auto;">
        <li onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'" ng-repeat="month in reg_months track by $index" ng-click="on_reg_month(month)">{{month}}月</li>
        
      </ul>
    </div>
    <div class="input-group-btn" >
      <button type="button" class="btn {{reg_btn_types[2]}} dropdown-toggle" data-toggle="dropdown" style="width:100%;" ng-click="on_reg_day_btn()">{{reg_day}}日<span class="caret"></span></button>
      <ul class="dropdown-menu dropdown-menu" role="menu" style="height:120px;overflow:auto;">
        <li onmouseover="this.style.backgroundColor='#00aaff'" onmouseout="this.style.backgroundColor='#FFFFFF'" ng-repeat="day in reg_days track by $index" ng-click="on_reg_day(day)">{{day}}日</li>
        
      </ul>
    </div>
  </div>
  <label class="col-sm-4 ari"><span><font color="{{reg_bir_hint_color}}">{{reg_bir_hint}}</font></span></label>
</div>

<div class="form-group">  
  <label for="username" class="col-sm-4 control-label ari" >真实姓名</label>
    <div class="col-sm-4">
      <div class="{{reg_details_styles[0]}}" style="width:100%;">
        <input type="text"  class="form-control" id="username" placeholder="真实姓名(2-30位字母,数字,汉字)" ng-change="on_reg_details_change(0)" ng-model="reg_details_contents[0]">
      </div>
    </div>
  <label class="col-sm-4 ari"><span><font color="{{reg_details_hint_color[0]}}">{{reg_details_hint[0]}}</font></span></label>
</div>

<div class="form-group">  
  <label for="username" class="col-sm-4 control-label ari" >联系电话</label>
    <div class="col-sm-4">
      <div class="{{reg_details_styles[1]}}" style="width:100%;">
        <input type="text"  class="form-control" id="username" placeholder="联系电话(5-15位数字)" ng-change="on_reg_details_change(1)" ng-model="reg_details_contents[1]">
      </div>
    </div>
  <label class="col-sm-4 ari"><span><font color="{{reg_details_hint_color[1]}}">{{reg_details_hint[1]}}</font></span></label>
</div>

<div class="form-group">  
  <label for="username" class="col-sm-4 control-label ari" >电子邮箱</label>
    <div class="col-sm-4">
      <div class="{{reg_details_styles[2]}}" style="width:100%;">
        <input type="text"  class="form-control" id="username" placeholder="联系电话(5-15位数字)" ng-change="on_reg_details_change(2)" ng-model="reg_details_contents[2]">
      </div>
    </div>
  <label class="col-sm-4 ari"><span><font color="{{reg_details_hint_color[2]}}">{{reg_details_hint[2]}}</font></span></label>
</div>