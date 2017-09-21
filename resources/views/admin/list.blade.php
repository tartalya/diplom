@extends('admin.admin')

@section('content')

<h2>{{$description}} {{\App\Http\Controllers\CategoriesController::getNameById($selectedId)}}</h2>
<div class="table-responsive">




    <Center><h1><font color="red"><div class="message" id="message">

                {{Session::get('msg')}}
            </div></font></h1></Center>

    <form name="category_id" method="POST"> 

        <select name="category_id">

            @foreach ($categories as $category)

            @if ($category->id == $selectedId)

            <option selected value="{{$category->id}}">{{$category->category_name}}</option>

            @else

            <option value="{{$category->id}}">{{$category->category_name}}</option>

            @endif

            @endforeach
        </select> 

        <input type="submit" name="action" value="change"> Применить</input>

    </form>

    <br><br>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Дата создания</th>
                <th>Вопрос</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>


            @foreach ($questions as $question)

            @if ($question->category_id == $selectedId)

            <tr>

                <td>{{$question->id}}</td>
                <td>{{$question->date_created}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->status_name}}</td>

            </tr>

            @endif

            @endforeach
        </tbody>
    </table>

</div>

@endsection


