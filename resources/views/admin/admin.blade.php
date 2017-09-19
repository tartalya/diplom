<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Панель администратора</title>

        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/css/dashboard.css" rel="stylesheet">
    </head>

    <body>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script>

$("#message").show();
setTimeout(function () {
    $("#message").hide();
}, 3000);

    </script>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="/admin">Панель администратора</a> 
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <a class="navbar-brand" style="float: right;position: relative;left: 95%;" href="/logout">Выйти</a>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Здравствуйте {{$content['admin_name']}}.</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Обзор <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users">Администраторы</a>
                        </li>
                        <br>

                        <li class="nav-item">
                        <center><b>Управление вопросами и ответами</b></center>
                        </li>                       

                        <li class="nav-item">
                            <a class="nav-link" href="/admin/answer/add">Список неотвеченных</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/admin/answer/manage">Список всех вопросов</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/answer/category/">Список вопросов по категориям</a>
                        </li>

                        <br>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/categories">Управление категориями</a>
                        </li>

                        <br>        

                    </ul>




                </nav>

                <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">


                    <h1>Общая информация по системе</h1>

                    <section class="row text-center placeholders">


                        <div class="col-6 col-sm-3 placeholder">
                        <!-- <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail"> -->
                            <h2>{{$content['not_answered_count']}}</h2>
                            <div class="text-muted">Вопросов без ответа</div>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">

                            <h2>{{$content['qa_count']}}</h2>
                            <span class="text-muted">Всего вопросов в базе</span>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">

                            <h2>{{$content['admin_count']}}</h2>
                            <span class="text-muted">Всего администраторов</span>
                        </div>
                        <div class="col-6 col-sm-3 placeholder">

                            <h2>{{$content['categories_count']}}</h2>
                            <span class="text-muted">Всего категорий</span>
                        </div>



                    </section>

                    @yield('content')

                </main>
            </div>
        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>


