<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>Часто задаваемые вопросы</title>
</head>
<body>
<header>
	<h1>Часто задаваемые вопросы</h1>
       
        
</header>
    
    
  
        
        
    
<section class="cd-faq">
    
    
    
	<ul class="cd-faq-categories">
		<!-- <li><a class="selected" href="#basics">Basics</a></li> -->
		<!-- <li><a href="#mobile">Mobile</a></li> -->
		
                @foreach ($catlist as $value)
                
                <li><a href="#{{$value->category_name}}">{{$value->category_name}}</a></li>
                
                
                @endforeach
                
                
                
              <!--  <a href="/ask"><span style="background-color: #5cb85c; color: white; padding: 5px; border-radius: 5px;">Задать нам вопрос</h1></span> -->
                    
	</ul> <!-- cd-faq-categories -->

 

	<div class="cd-faq-items">
            
            <a href="/ask"><span style="background-color: #5cb85c; color: white; padding: 5px; border-radius: 5px; float: right;">Задать нам вопрос</span></a>
            
            @foreach ($catlist as $category)
            
		<ul id="{{$category->category_name}}" class="cd-faq-group">
			<li class="cd-faq-title"><h2>{{$category->category_name}}</h2></li>
			
                        @foreach ($output as $faq)
                        
                        @if ($category->id == $faq->category_id)
                        
                        <li>
				<a class="cd-faq-trigger" href="#0">{{$faq->question}}</a>
				<div class="cd-faq-content">
					<p>{{$faq->answer}}</p>
				</div> <!-- cd-faq-content -->
			</li>
                        
                        @endif
                        
                        @endforeach
			
		</ul> <!-- cd-faq-group -->

		@endforeach
		
	</div> <!-- cd-faq-items -->
        <br><br>
        
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>