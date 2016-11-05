@extends('template.index')

@section('content')
            <h1>Последние новости: </h1>

            @foreach($articles as $article)
                <hr>
                <p class="article-info-small">
                    <a href="/articles/{{ $article->id }}">
                        @if($article->img != 'none.png')
                            <img src="/img/{{ $article->img }}" alt="Изображение новости"/>
                        @endif
                            {{ $article->name }}</a>
                    <br />

                    {!! $article->desc_s !!}
                </p>

                <br style="clear: both;" /><br />
            @endforeach

@stop

