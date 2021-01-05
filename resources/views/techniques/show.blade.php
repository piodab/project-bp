@extends('layouts.app')

@section('title', 'Tactics Enterprise')

@section('menu-name', 'Techniques')

@section('menu-group-name', '')

@section('menu-additional-item')

    @foreach($groupedTechniques as $key => $techGroups)
        <li>
            <a href="#{{$key}}" data-toggle="collapse" aria-expanded="false"
               class="dropdown-toggle">{{ ucwords(str_replace('-',' ',$key)) }}</a>
            <ul class="collapse list-unstyled" id="{{$key}}">
                @foreach($techGroups as $tech)
                    <li>
                        <a href="{{ route('techniques.show', [
                                    explode('.', $tech->external_id)[0],
                                    explode('.', $tech->external_id)[1] ?? '000',
                                    ])
                                }}">
                            {{ $tech->name }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>
    @endforeach

@endsection

@section('content')
    <h1>{{$technique->name}}</h1>
    <p>{{$technique->description}}</p>
@endsection

