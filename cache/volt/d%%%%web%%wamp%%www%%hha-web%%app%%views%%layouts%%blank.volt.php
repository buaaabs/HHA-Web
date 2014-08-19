<head>
    <meta charset="utf-8">

    
    <?php echo $this->tag->getTitle(); ?>
    
    
    
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap-theme.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/main-style.css'); ?>
    
    
    
<style type="text/css">
	body {background-color: #eee;}
</style>

    
       
    <?php echo $this->tag->javascriptInclude('js/jquery.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('bootstrap/js/bootstrap.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('js/jquery.leanModal.min.js'); ?>
    <script type="text/javascript">
        $().ready(function () {
            $("#register_btn").leanModal();
        });
    </script>
    
    
    
    
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="It's a hha software introduce page">
    <meta name="author" content="sxf">
    

    
    
</head>
<body>
     

    <div class="container body-div">
        <?php echo $this->getContent(); ?>
    </div>
     
</body>
