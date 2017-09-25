@extends('admin.admin')

@section('content')


<h2>{{$description}}</h2>
<div class="table-responsive">





    <Center><h1><font color="red"><div class="message" id="message">

                {{Session::get('msg')}}
            </div></font></h1></Center>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Категория</th>
                <th>Вопросов в теме</th>
                <th>Опубликованых в теме</th>
                <th>Без ответов в теме</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        <form name="category" method="POST"> 

            @foreach ($categories as $category)
            <tr>

                <td>{{$category->id}}</td>
                <td>


                    <input name="category_name" type="text" value="{{$category->category_name}}">


                </td>

                <td>{{\App\Faq::where('category_id', $category->id)->count()}}</td>
                <td>{{\App\Faq::where('category_id', $category->id)->where('status_id', 3)->count()}}</td>
                <td>{{\App\Faq::where('category_id', $category->id)->where('status_id', 1)->count()}}</td>

                <td><input type="hidden" name="category_id" value="{{$category->id}}"></td>
                <td><input type="submit" name="action" value="edit"></td>
                <td><input type="submit" name="action" value="delete"></td>

            </tr>

            @endforeach


        </form>

        </tbody>
    </table>

</div>



<br><br>

<h2>Добавление новой категории</h2>

<br>

<div class="table-responsive">

    <form name="category_add" method="POST">    

        <table class="table table-striped">

            <thead>
                <tr>

                    <th>Название категории</th>

                </tr>
            </thead>

            <tr>
                <td>
                    <input type="text" name="category_name">
                </td>

                <td>
                    <input type="submit" name="action" value="add">
                </td>

            </tr>

        </table>
    </form>

</div>

@endsection

