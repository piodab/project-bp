@extends('layouts.app')

@section('title', 'Tactics Enterprise')

@section('menu-name', 'Tactics')

@section('menu-group-name', 'Enterprise')

@section('sidebar')
    <ul>
        @foreach($tactics as $tactic)
            <li>
                <a href="{{ route('tactics.show', $tactic->external_id) }}">
                    {{ $tactic->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection

@section('content')
    <div>
        <h1>Enterprise tactics</h1>
        <br>
        <form class="form-inline" method="GET" action="">
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="search" placeholder="Search">
            </div>

            <button type="submit" class="btn btn-info mb-2">
                Search
            </button>
        </form>

        <br>
        Techniques: <i class="text-primary">{{ count($techniques) }}</i>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            @foreach($techniques as $technique)
                <tr>
                    <td>
                        <a href="{{ route('techniques.show', [
                        explode('.', $technique->external_id)[0],
                        explode('.', $technique->external_id)[1] ?? '000',
                        ])
                    }}" class="text-info">
                            {{ $technique->external_id }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('techniques.show', [
                        explode('.', $technique->external_id)[0],
                        explode('.', $technique->external_id)[1] ?? '000',
                        ])
                    }}" class="text-info">
                            {{ $technique->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
