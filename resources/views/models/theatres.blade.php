@extends('template.index')

@section('content')
    <h1>Театры, с которыми мы работаем:</h1>

    @foreach($theatres as $theatre)
        <p class="theatre">
            <a href="/theatres/{{ $theatre->id }}">
                {{ $theatre->name }}</a> <br /> <br />
            <b>Адрес: </b> {{ $theatre->address }} <br />
            <b>Телефон: </b> {{ $theatre->tel_num }}

        </p>

        <br style="clear: both;" /><br />
    @endforeach

@stop

