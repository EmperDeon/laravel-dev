@extends('template.index')

@section('content')
    <div class="col-md-12">
        <h1> {{ $theatre->name }} </h1>

        <div>
            <img src="/img/{{ $theatre->img }}" alt="Изображение театра" style="float: left; width: 420px; padding: 0 20px 20px 0"/>
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
    </div>

@stop

