@extends('layouts.app')

@section('content')

    <div class="content">
        <h3 class="text-center">Рейтинг гравців гри {{ $game->name }}</h3>
        <a href="{{ route('ratings.add', ['game_id' => $game->id]) }}">Поставити оцінку</a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table">
            @forelse($ratings as $userId => $rating)
                <tr>
                    <td><a href="{{ route('ratings.game.user', [
                        'game_id' => $game->id,
                        'user_id' => $userId
                        ]) }}">{{ $users[$userId]->name }}</a>
                    <td>
                    <td>{{ $rating }}
                    <td>
                </tr>
            @empty
                <p>Поки ще ніхто оцінок немає</p>
            @endforelse
        </table>
    </div>

@endsection