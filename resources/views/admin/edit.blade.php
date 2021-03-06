@extends('admin.admin')

@section('content')


<h2>Список администраторов</h2>




<Center><h1><font color="red"><div class="message" id="message">

            {{Session::get('msg')}}
        </div></font        ></h1></Center>


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
        <!-- <form name="admin_edit" method="POST" action="/admin/users/{{$value->id}}/"> -->
        <form name="admin_edit" method="POST" action="{{route('user.update', ['id' => $value->id], false)}}">
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
                <input type="submit" name="action" value="Изменить">   
                {{ method_field('PUT') }}
                {{ csrf_field() }}


            
        </form>


        <form method="POST" action="{{route('user.update', ['id' => $value->id], false)}}">

            {{ method_field('DELETE') }}  
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$value->id}}">
            <input type="submit" name="action" value="Удалить">
        </form>

        </td>
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

    <form name="user_add" method="POST" action="{{route('user.store')}}">    

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
                    {{ csrf_field() }}
                    <input type="submit" name="action" value="Создать">
                </td>

            </tr>

        </table>
    </form>

</div>

@endsection
