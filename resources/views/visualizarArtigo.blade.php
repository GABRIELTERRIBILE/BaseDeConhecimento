@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
    <div class="container">
        <div class="input-container text-right">
            <input type="button" value="Voltar" class="btn btn-primary" onclick="location.href='{{ url('/') }}'">
        </div>
        <div>
            <h1 class="text-center"> {!! $content-> subject !!}</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        <form action="{{ url('/view-content/' . $content->id . '/send-email') }}" method="POST">
            @csrf

            <div class="text-center" style="display: flex; justify-content: flex-end;">
                <input type="email" name="email" class="form-control mr-n2" id="exampleFormControlInput1" placeholder="joao@outlook.com" style="width: 20%;">
                <button class="btn btn-outline-secondary" type="submit" id="send-button"><i class="bi bi-envelope"></i></button>
            </div>
        </form>

        <br>
        <h1 class="left bold small">Autor: {!! $content-> name !!}</h1>
        <h1 class="right bold small">Artigo: {!! $content-> id !!}</h1>
        <p>
        <hr>
            <div class="content">
            {!! $content->conteudo !!}
            </div>
        <hr>
        </div>
    </div>
<script>
    document.getElementById('send-button').addEventListener('click', function() {
        this.disabled = true;
    });
</script>
@endsection
