<h1><center>{{article_pri_title}}</center></h1>
<h4><center>{{article_sub_title}}</center></h4>
<h5>{{article_date}}</h5>
<hr style="border:1px dashed #0000fff"/>
<div>
	<p ng-bind-html="get_safe_article(article_main)"></p>
</div>

<h5 align="right">编辑：{{article_editor}}</h5>