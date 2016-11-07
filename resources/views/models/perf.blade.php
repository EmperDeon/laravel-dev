@extends('template.index')

@section('content')
    <h2>Репертуар </h2> @include('part.perf-types')
    <h3> {{ $perf->perf->name }} </h3>
    <a href="/theatres/{{ $perf->theatre_id }}"><h5> {{ $perf->theatre->name }}</h5></a>
    <a href="/performances/{{ $perf->theatre_id }}"><h5>{{ $perf->perf->type->name }}</h5></a>
    <div class="perf-info-big">
        <div class="row">
            <div class="col-md-8">
                <img src="/img/{{ $perf->img }}" alt="Изображение выступления"/> <br />
                <b>Автор: </b> {{ $perf->perf->author }} <br />
                <p>
                    {!! $perf->desc !!}
                    @lang('global.lorem-s')
                </p>
            </div>
            <div class="col-md-4">
                <table class="table" style="font-size: 10pt">
                    <tbody>
                    <tr><td style="border:0px !important"></td></tr>
                    <tr><td>Кай Марций, затем Кай Марций Кориолан</td><td><a href="/actors/truppa-teatra/Dmitriy-Mulyar">Дмитрий Муляр</a></td></tr>
                    <tr><td>Коминий</td><td><a href="/actors/truppa-teatra/Sergey-Veksler">Сергей Векслер</a></td></tr>
                    <tr><td>Менений Агриппа, друг Кориолана</td><td><a href="/actors/truppa-teatra/Anatoliy-Vasilev">Анатолий Васильев</a><br><a href="/actors/truppa-teatra/Aleksandr-Rezalin">Александр Резалин</a></td></tr><tr><td>Сициний Велут</td><td><a href="/actors/truppa-teatra/Filipp-Kotov">Филипп Котов</a></td></tr><tr><td>Юний Брут</td><td><a href="/actors/truppa-teatra/Igor-Pehovich">Игорь Пехович</a><br><a href="/actors/truppa-teatra/Roman-Staburov">Роман Стабуров</a></td></tr><tr><td>Тулл Авфидий, полководец вольсков</td><td><a href="/actors/truppa-teatra/Sergey-Trifonov">Сергей Трифонов</a></td></tr><tr><td>Волумния, мать Кориолана</td><td><a href="/actors/truppa-teatra/Anastasiya-Kolpikova">Анастасия Колпикова</a></td></tr><tr><td>Виргилия, жена Кориолана</td><td><a href="/actors/truppa-teatra/Anna-Nikolaevskaya">Анна Николаевская</a><br><a href="/actors/truppa-teatra/Olga-Shatrova">Ольга Шатрова</a></td></tr><tr><td>Военачальник</td><td><a href="/actors/truppa-teatra/Konstantin-Lyubimov">Константин Любимов</a></td></tr><tr><td>Горожане</td><td><a href="/actors/truppa-teatra/Anna-Bukatina">Анна Букатина</a><br><a href="/actors/truppa-teatra/Elizaveta-Visotskaya">Елизавета Высоцкая</a><br><a href="/actors/truppa-teatra/Teymuraz-Glonti">Теймураз Глонти</a><br><a href="/actors/truppa-teatra/Marfa-Koltsova">Марфа Кольцова</a><br><a href="/actors/truppa-teatra/Nikita-Luchihin">Никита Лучихин</a><br><a href="/actors/truppa-teatra/Aleksandr-Margolin">Александр Марголин</a><br><a href="/actors/truppa-teatra/Ekaterina-Ryabushinskaya">Екатерина Рябушинская</a><br><a href="/actors/truppa-teatra/Sergey-Tsimbalenko">Сергей Цимбаленко</a></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

