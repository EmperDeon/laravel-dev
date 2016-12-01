@extends('template.index')

@section('content')
    <h1> {{ $theatre->name }} </h1>

    <div class="theatre">
        <img src="/img/{{ $theatre->img }}" alt="Изображение театра"/>
        <p>
            {!! $theatre->desc !!}
            @lang('global.lorem')
        </p>
    </div>

    <table class="table">
        <tr>
            <td> Адрес: </td><td> {{ $theatre->address }} </td>
        </tr>
        <tr>
            <td> Телефон: </td><td> {{ $theatre->tel_num }} </td>
        </tr>
    </table>

@stop

