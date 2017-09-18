@extends('admin.admin')

@section('content')

<h2>{{$description}}</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Номер</th>
                <th>Дата добавления</th>
                <th>Категория</th>
                <th>Статус</th>
                <th>Имя спросившего</th>
                <th>Почта спросившего</th>
                <th>Вопрос</th>
                <th>Ответ</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>

        <pre>
   
    
     @foreach ($questions as $value)
            <tr>
        <form name="answer_edit" method="POST">
            <td>
                {{$value->id}}
            </td>

            <td>
                {{$value->date_created}}
            </td>

            

            <td>
                
                
            <select name="category">
                
                    
                @foreach ($categories as $category)
                
                
                @if ($category->category_name == $value->category_name) 
                
                <option selected value="{{$category->id}}">{{$category->category_name}}</option>
                
                @else 
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                    
                @endif    
                    
               
                @endforeach
                
                </select>
   
            
            </td>
            
            
            <td>
                
                <select name="status">
                
                    
                @foreach ($statuses as $status)
                
                
                @if ($status->status_name == $value->status_name) 
                
                <option selected value="{{$status->id}}">{{$status->status_name}}</option>
                
                @else 
                <option value="{{$status->id}}">{{$status->status_name}}</option>
                    
                @endif    
                    
               
                @endforeach
                
                </select>
            </td>
            
            
            
            <td>
                <input type="text" name="questioner_name" value="{{$value->questioner_name}}">
            </td>

            <td>
                <input type="text" name="questioner_email" value="{{$value->questioner_email}}">
            </td>

            <td>
                <textarea name="question" style="margin-top: 0px; margin-bottom: 0px; height: 170px;">{{$value->question}}</textarea>
            </td>
            
            <td>
                <textarea name="answer" style="margin-top: 0px; margin-bottom: 0px; height: 170px;">{{$value->answer}}</textarea>
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

</div>

@endsection
