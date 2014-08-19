<head>
    <meta charset="utf-8">

    
    <?php echo $this->tag->getTitle(); ?>
    
    
    
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap-theme.min.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/main-style.css'); ?>
    
    
    
    
    
       
    <?php echo $this->tag->javascriptInclude('js/jquery.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('bootstrap/js/bootstrap.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('js/jquery.leanModal.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('js/src/jquery.goup.js'); ?>
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
    
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="navbar-header">
            <div class="container">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">HHA</a>
                <?php echo $this->elements->getMenu(); ?>
            </div>
        </div>
    </div>
    

    <div class="container body-div">
        <?php echo $this->getContent(); ?>
    </div>
    
    <?php echo $this->partial('shared/footer'); ?>
    
</body>
