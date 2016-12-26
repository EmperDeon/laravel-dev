@extends('template.index')

@section('content')
    <h2>Выступление</h2>
    @include('part.perf-types')

    <h3 style="margin:10px"> {{ $perf->perf->name }} </h3>
    <div class="perf">
        <div class="row">
            <div class="col-md-12">
                <h4>Ближайшие спектакли:</h4>
                <table class="table" style="font-size: 9.5pt">
                    @foreach($posters as $poster)
                        <tr>
                            <td>
                                {{ Date::parse($poster->date)->format('d F Y G:i, l') }}
                            </td>
                            <td>
                                {{ $poster->hall->name }}
                            </td>
                        </tr>
                    @endforeach
                </table>

                <b>Автор: </b> {{ $perf->perf->author }} <br /><br />
                <p>
                    {!! $perf->desc !!}
                </p>
            </div>
            {{--<div class="col-md-4">--}}
                {{--<h4>Актеры:</h4>--}}
                {{--<table class="table" style="font-size: 10pt">--}}
                    {{--<tbody>--}}
                    {{--@foreach($perf->actors as $actor)--}}
                        {{--<tr><td><a href="/actors/{{ $actor->id }}">{{ $actor->name }}</a></td></tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>
    </div>
@stop

