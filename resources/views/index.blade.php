@extends('template.index')

@section('content')
    <h1>Главная страница</h1>

    <h3>Ближайшие спектакли:</h3>
    <div class="posters container">
        <div class="row">
            @foreach ($posters as $poster)
                <div class="poster-small col-sm-6 col-md-3 col-lg-3">
                    <div class="date">{{ Date::parse($poster->date)->format('d F Y, l G:i') }}</div>
                    <a href="/performances/{{ $poster->id }}">{{ $poster->t_perf->perf->name }}</a><br />
                    <a href="/theatres/{{ $poster->t_perf->theatre_id }}" style="font-size: 10pt">{{ $poster->t_perf->theatre->name }}</a><br />
                    <a href="#" style="font-size: 10pt">{{ $poster->hall->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
    <p></p>
<?php
Date::setLocale('ru');

echo Date::now()->format('');
?>
    <h3>Последние новости: </h3>

    @foreach($articles as $article)
        <hr>
        <div class="article-small">
            <div style="float: left">
                <a href="/articles/{{ $article->id }}">{{ $article->name }}</a><br />
                <a href="/theatres/{{ $article->theatre_id }}" style="font-size: 10pt">{{ $article->theatre->name }}</a><br />
            </div>
            <div style="float: right">
                {{ Date::parse($article->updated_at)->format('d F Y') }}
            </div>

            <br style="clear: both;" />
            @if($article->img == 'none.png')
                <br /><a href="/articles/{{ $article->id }}">
                </a>
            @endif

            {!! $article->desc_s !!}
            <a class="btn btn-default" href="/articles/{{ $article->id }}">Подробнее</a>
        </div>
        <br style="clear: both;" /><br />
    @endforeach

@stop

