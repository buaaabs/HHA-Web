<head>
    <meta charset="utf-8">

    {% block title %}
    {{ get_title() }}
    {% endblock %}
    
    {% block css %}
    {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
    {{ stylesheet_link('bootstrap/css/bootstrap-theme.min.css') }}
    {{ stylesheet_link('css/main-style.css') }}
    {% endblock %}
    
    {% block addcss %}
    {% endblock %}
    
    {% block js %}   
    {{ javascript_include('js/jquery.min.js') }}
    {{ javascript_include('bootstrap/js/bootstrap.min.js') }}
    {{ javascript_include('js/jquery.leanModal.min.js') }}
    {{ javascript_include('js/src/jquery.goup.js') }}
    <script type="text/javascript">
        $().ready(function () {
            $("#register_btn").leanModal();
        });
    </script>
    {% endblock %}
    
    {% block addjs %}
    {% endblock %}
    
    {% block other %}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="It's a hha software introduce page">
    <meta name="author" content="sxf">
    {% endblock %}

    {% block addother %}
    {% endblock %}
</head>
<body>
    {% block nav %}
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="navbar-header">
            <div class="container">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">HHA</a>
                {{ elements.getMenu() }}
            </div>
        </div>
    </div>
    {% endblock %}

    <div class="container body-div">
        {{ content() }}
    </div>
    {% block footer %}
    {{ partial("shared/footer") }}
    {% endblock %}
</body>
