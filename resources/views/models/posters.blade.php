@extends('template.index')

@section('content')
    <h2>Афиша </h2> @include('part.perf-types')

    <table class="table">
    @foreach($posters as $poster)
        <tr>
            <td>
                {{ $poster->date }}
            </td>
            <td>
            <a href="/poster->t_performances/{{ $poster->t_perf->id }}">
                {{ $poster->t_perf->perf->name }}
            </a><br />
            <a href="/theatres/{{ $poster->t_perf->theatre_id }}" style="font-size: 10pt">{{ $poster->t_perf->theatre->name }}</a>


            </td>
            <td>

            </td>
        </tr>
    @endforeach
    </table>
@stop

