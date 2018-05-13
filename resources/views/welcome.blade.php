<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <meta property="og:title" content="{{config('app.name')}}">
    <meta name="twitter:title" content="{{config('app.name')}}">
    <meta property="og:description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">
    <meta name="twitter:description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">
    <meta name="description" content="Googleサジェストワード導出ツールです。サジェストワードを再帰的に全て導出してきます。">


    <!-- あとで編集する -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:image" content="{{url('/eyecatch.png')}}">
    <meta name="twitter:image" content="{{url('/eyecatch.png')}}">

    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{url('/apple-touch-icon.png')}}" sizes="180x180">
    <link rel="icon" href="{{url('/favicon192.png')}}" sizes="192x192">　

    <meta property="og:site_name" content="{{config('app.name','Laravel')}}">
    <meta property="og:locale" content="ja_JP">
    <meta property="fb:app_id" content="339751459830292">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{url()->current()}}">
    <meta name="twitter:domain" content="svschool.jp">
    <meta name="twitter:creator" content="@ryokurosu">
    <meta name="twitter:site" content="@ryokurosu">
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .search-word{
     animation: fadeIn 1s;
 }
 #word {
    text-align:  left;
}
@keyframes fadeIn {
    0% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
}
#footer {
    text-align:  center;
    color: gray;
}
#footer a{
    text-decoration:underline;
    color:gray;
}
</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
         <a href="{{ url('/home') }}">Home</a>
     </div>

     <div class="content">
        <div class="title m-b-md">
            {{config('app.name')}}
        </div>

        <div id="word">
            @foreach(\App\Word::orderBy('updated_at','desc')->take(10)->get() as $word)
            <p class="search-word" data-id="{{$word->id}}">「{{$word->word}}」で検索されました。</p>
            @endforeach
        </div>
    </div>
</div>
<footer id="footer">
    Powered By <a href="https://twitter.com/ryokurosu">@ryokurosu</a>
</footer>
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script>
    $(function(){

        function updateWord(){
            var p_id = $('#word .search-word:first-of-type').attr('data-id');
            $.ajax({
                type : "POST",
                　　　data: {
                    lastid : p_id
                　　　},
                　　　url : "{{url('/update')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                　　　success : function(data) {
                    var element = $('<p class="search-word" data-id="' + data['id'] + '">「' + data['word'] +'」で検索されました。</p>');
                    $('#word').prepend(element);
                    $('#word > .search-word:last-of-type').remove();
                　　　},
                　　　error : function(data) {

                　　}　
            });
            setTimeout(updateWord,5000);
        }
        setTimeout(updateWord,5000);
    });
</script>
</body>
</html>
