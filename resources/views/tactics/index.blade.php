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
            Enterprise tactics: <i class="text-primary">{{ count($tactics) }}</i>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                @foreach($tactics as $tactic)
                    <tr>
                        <td>
                            <a href="{{ route('tactics.show', $tactic->external_id) }}" class="text-info">
                                {{ $tactic->external_id }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('tactics.show', $tactic->external_id) }}" class="text-info">
                                {{ $tactic->name }}
                            </a>
                        </td>
                        <td>{{ explode(PHP_EOL, $tactic->description)[0] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
@endsection
