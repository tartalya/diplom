<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">

        <title>Задать вопрос</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style type="text/css">
            body{
                background: url(http://mymaplist.com/img/parallax/back.png);
                background-color: #444;
                background: url(http://mymaplist.com/img/parallax/pinlayer2.png),url(http://mymaplist.com/img/parallax/pinlayer1.png),url(http://mymaplist.com/img/parallax/back.png);    
            }
            .vertical-offset-100{
                padding-top:100px;
            }
        </style>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            window.alert = function () {};
            var defaultCSS = document.getElementById('bootstrap-css');
            function changeCSS(css) {
                if (css)
                    $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="' + css + '" type="text/css" />');
                else
                    $('head > link').filter(':first').replaceWith(defaultCSS);
            }
            $(document).ready(function () {
                var iframe_height = parseInt($('html').height());
                window.parent.postMessage(iframe_height, 'https://bootsnipp.com');
            });
        </script>
    </head>
    <body>


        <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
        <!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

        <div class="container">
            <div class="row vertical-offset-100">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Задайте свой вопрос</h3>
                        </div>
                        <div class="panel-body">
                            <form accept-charset="UTF-8" role="form" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Ваше имя" name="name" type="text">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Ваш e@mail" name="email" type="email" value="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" placeholder="Ваш вопрос" name="question" type="text" value="">
                                    </div>

                                    <div class="form-group">

                                        <select class="form-control" name="category">

                                            <option value="">Выберите категорию вопроса</option>

                                            @foreach ($categories as $value)

                                            <option value="{{$value->id}}">{{$value->category_name}}</option>

                                            @endforeach

                                        </select>

                                    </div>
                                    {{ csrf_field() }}
                                    <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Отправить">
                                </fieldset>

                                <center><b>

                                        @if (isset($msg))

                                        {{$msg}}

                                        @endif
                                    </b></center>


                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>


