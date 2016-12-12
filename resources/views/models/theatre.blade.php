@extends('template.index')

@section('content')
    <h1> {{ $theatre->name }} </h1>

    <div class="theatre">
        <p>
            {!! $theatre->desc !!}
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

