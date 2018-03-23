@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <h2>Games</h2>
    </div>
    <div class="content">
        <a href="{{ route('games.create') }}">Додай гру першим</a>
        <table class="table">
            @forelse($games as $game)
                <tr>
                    <td>{{ $game->date }}<td>
                    <td><a href="{{ route('ratings.game', ['game_id' => $game->id]) }}">{{ $game->name }}</a><td>
                    <td>{{ $game->note }}<td>
                    <td>{{ count($game->ratings) }}<td>
                    <td>
                        <a href="{{ route('games.show', ['id' => $game->id]) }}"> Деталі</a>
                        <a href="{{ route('games.edit', ['id' => $game->id]) }}"> Редагувати</a>
                        <a href="{{ route('games.delete', ['id' => $game->id]) }}"> Видалити</a>
                    <td>
                </tr>
            @empty
                <p>Поки ще ніхто немає ігор</p>
            @endforelse
        </table>
    </div>
@endsection
