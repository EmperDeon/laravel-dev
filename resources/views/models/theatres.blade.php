@extends('template.index')

@section('content')
    <div class="col-md-12">
        <h1>Театры, с которыми мы работаем:</h1>

        @foreach($theatres as $theatre)
            <p class="theatre-info">
                <a href="/theatres/{{ $theatre->id }}"> <img src="/img/{{ $theatre->img }}" alt="Изображение театра"/>{{ $theatre->name }}</a> <br /> <br />
                <b>Адрес: </b> {{ $theatre->address }} <br />
                <b>Телефон: </b> {{ $theatre->tel_num }}

            </p>

            <br style="clear: both;" /><br />
        @endforeach
    </div>

@stop

