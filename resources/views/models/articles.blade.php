@extends('template.index')

@section('content')
    <h1>Последние новости: </h1>

    @foreach($articles as $article)
        <hr>
        <div class="article-small">
            <div style="float: left">
                <a href="/articles/{{ $article->id }}">{{ $article->name }}</a>
            </div>
            <div style="float: right">
                {{ \Carbon\Carbon::parse($article->created_at)->formatLocalized('%d %B %Y') }}
            </div>

            <br style="clear: both;" />
            @if($article->img == 'none.png')
                <br /><a href="/articles/{{ $article->id }}"><img src="/img/{{ $article->img }}" alt="Изображение новости" /></a>
            @endif

            {!! $article->desc_s !!}
            <a class="btn btn-default" href="/articles/{{ $article->id }}">Подробнее</a>
        </div>
        <br style="clear: both;" /><br />
    @endforeach

@stop

