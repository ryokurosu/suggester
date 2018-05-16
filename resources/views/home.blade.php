@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Googleサジェストワード抽出</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="form-group row">
                        <label for="word" class="col-sm-4 col-form-label text-md-right">{{ __('抽出ワード') }}</label>

                        <div class="col-md-6">
                            <input id="word" type="text" class="form-control{{ $errors->has('word') ? ' is-invalid' : '' }}" name="word" value="{{ old('word') }}" required autofocus>

                            @if ($errors->has('word'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('word') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="word" class="col-sm-4 col-form-label text-md-right">{{ __('マークアップ') }}</label>

                        <div class="col-md-6">
                            無 <input type="radio" name="markup" value="0" checked>       有 <input type="radio" name="markup" value="1">
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button id="submit" class="btn btn-primary">
                             抽出
                         </button>
                         <small>※リクエストが集中している場合、結果が正しく表示されない可能性があります。その場合は時間を置いてお試しください。</small>
                     </div>
                 </div>

                 <div class="card-body">
                    <center>
                        <img id="loading" style="display:none" src="{{url('/loading.gif')}}" alt="ロード中です。">
                    </center>
                    <pre id="result">

                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script>
    $(function(){
        $("#submit").on('click',function(){
            $('#loading').css('display','block');
            $('#result').html('');
            var word = $('#word').val();
            var markup = $('input[name="markup"]:checked').val();
            $.ajax({
                type : "POST",
                　　　data: {
                    word : word,
                    markup : markup
                　　　},
                　　　url : "{{url('/post')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                　　　success : function(data) {
                   $('#loading').css('display','none');
                   $('#result').html(data);
               　　　},
               　　　error : function(data) {
                   $('#loading').css('display','none');
                   　$('#result').html('<p>エラーが発生しました。</p>');
               　　}　
           });

        });
    });
</script>
@endsection
