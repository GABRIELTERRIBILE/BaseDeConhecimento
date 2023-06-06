@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1 class="text-center">{{ isset($post) ? 'Editando artigo...' : 'Criando do artigo...' }}</h1>
        <hr>
    </div>
    <script src="https://cdn.tiny.cloud/1/dp9yjkvz1rlbiojvwc7pmmqx4zkvgwr4lm2d1x6hzmdkhwxc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <form method="POST" action="/salvar-conteudo/{{ isset($post) ? $post->id : '' }}">
        @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Autor</span>
            </div>
            <input type="text" id="name" name="name" class="form-control" placeholder="João Kleber" aria-label="Username" aria-describedby="basic-addon1" required
            @if (isset($post))
                value="{{ $post->name }}"
            @endif>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Assunto</span>
            </div>
            <input type="text" id="subject" name="subject" class="form-control" placeholder="Coloque aqui o assunto do artigo!" aria-label="subject" aria-describedby="basic-addon1" required
            @if (isset($post))
                value="{{ $post->subject }}"
            @endif>
        </div>
        <td>
            <textarea id="editor" name ="conteudo">
            @if (isset($post))
                {{ $post->conteudo }}
            @endif
            </textarea>
            <hr>
            <div>
                <input type="submit" class="btn btn-primary" value="Salvar" style="float: right; margin-left: 10px; width: 100px; height: 40px; text-align: center;">
                <input type="button" value="Cancelar" class="btn btn-primary" onclick="location.href='{{ url('/home') }}'" style="float: right; background-color: red; border: none; outline: none; width: 100px; height: 40px; text-align: center;">
            </div>
        </td>
    </form>
    <script>
        tinymce.init({
        selector: '#editor',
        plugins: 'anchor inlinecss autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        entity_encoding:'raw',
        });

        document.querySelector('form').addEventListener('submit', function() {
        document.querySelector('conteudo').value = tinymce.get('editor').getContent();
    });
    </script>
<style>
.input-container {
  text-align: right !important;
}
</style>
</div>
@endsection
