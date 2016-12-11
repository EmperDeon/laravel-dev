@extends('template.index')

@section('content')
    <h1> {{ $actor->name }} </h1>

    <div class="theatre">
        {{--<img src="/img/{{ $theatre->img }}" alt="Изображение театра"/>--}}
        <p>
            {!! $actor->bio !!}
        </p>
    </div>
@stop

