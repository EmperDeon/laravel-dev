@extends('template.index')

@section('content')
    <h1>{{ $article->name }}</h1>
    <hr>
    <p class="article">
        <img src="/img/{{ $article->img }}" alt="Изображение новости"/>

        {!! $article->desc !!}
    </p>

    <br style="clear: both;" /><br />

@stop

