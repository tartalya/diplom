@extends('admin.admin')

@section('content')


<h2>Список администраторов</h2>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
    
$("#message").show();
setTimeout(function () {
    $("#message").hide();
}, 3000);

    </script>


    <Center><h1><font color="red"><div class="message" id="message">
                
                {{Session::get('msg')}}
            </div></font></h1></Center>


<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Имя</th>
                <th>Логин для входа</th>
                <th>Почта</th>
                <th>Пароль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>


            @foreach ($users as $value)
            <tr>
        <form name="admin_edit" method="POST">
            <td>
                {{$value->id}}
            </td>

            <td>
                <input type="text" name="name" value="{{$value->name}}">
            </td>

            <td>
                <input type="text" name="login" value="{{$value->login}}">
            </td>


            <td>
                <input type="email" name="email" value="{{$value->email}}">
            </td>

            <td>
                <input type="password" name="password" value="">
            </td>

            <td>

                <input type="hidden" name="id" value="{{$value->id}}">
                <input type="submit" name="action" value="edit">
                <input type="submit" name="action" value="delete">
            </td>
        </form>
        </tr>
        @endforeach





        </tbody>
    </table>

    <br>
    <span style="font-size: 0.8rem">*Внимание, пароль не выводиться в форму так как он находиться в базе в зашифрованном виде !!!</span>



</div>

<br><br>

<h2>Добавление нового администратора</h2>

<br>

<div class="table-responsive">

    <form name="user_add" method="POST">    

        <table class="table table-striped">

            <thead>
                <tr>

                    <th>Имя администратора</th>
                    <th>Логин для входа</th>
                    <th>Почтовый ящик нового администратора</th>
                    <th>Пароль нового администратора</th>
                    <th>Действия</th>
                </tr>
            </thead>

            <tr>
                <td>
                    <input type="text" name="name">
                </td>
                <td>
                    <input type="text" name="login">
                </td>
                <td>
                    <input type="text" name="email">
                </td>
                <td>
                    <input type="password" name="password">
                </td>
                <td>
                    <input type="submit" name="action" value="add">
                </td>

            </tr>

        </table>
    </form>

</div>

@endsection
