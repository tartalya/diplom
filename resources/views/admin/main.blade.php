       
@extends('admin.admin')

@section('content')



<h2>Последние 15 вопросов</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Дата создания</th>
                <th>Имя спросившего</th>
                <th>Емайл спросившего</th>
                <th>Вопрос</th>
                <th>Ответ</th>
                <th>Категория</th>
            </tr>
        </thead>
        <tbody>


            @foreach ($lastQuestions as $value)
            <tr>

                <td>
                    {{$value->id}}
                </td>

                <td>
                    {{$value->date_created}}
                </td>

                <td>
                    {{$value->questioner_name}}
                </td>

                <td>
                    {{$value->questioner_email}}
                </td>

                <td>
                    {{$value->question}}
                </td>

                <td>
                    {{mb_strimwidth($value->answer, 0, 310, " ...")}}
                </td>

                <td>
                    {{$value->category->category_name}}
                </td>

            </tr>
            @endforeach




        </tbody>
    </table>
</div>

@endsection