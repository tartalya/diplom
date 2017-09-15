@extends('admin.admin')

@section('content')


<h2>Список администраторов</h2>
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
                    <input type="submit" name="action" value="Изменить">
                    <input type="submit" name="action" value="Удалить">
                </td>
        </form>
            </tr>
            @endforeach
          




        </tbody>
    </table>
    
    <br>
    <span style="font-size: 0.8rem">*Внимание, пароль не выводиться в форму так как он находиться в базе в зашифрованном виде !!!</span>
    <br>
    <span style="font-size: 0.8rem">*Так как пароль не выводиться в форму, при любом изменении только одного параметра, необходимо вводить пароль в форму !!!</span>
</div>


@endsection
