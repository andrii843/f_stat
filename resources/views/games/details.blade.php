@extends('layouts.app')

@section('content')
<div class="content col-sm-offset-3 col-sm-6">
    <h3 class="text-center">Деталі гри {{ $game->name }}</h3>
    <table class="table table-striped">
        <tr>
            <td>Назва</td>
            <td>{{ $game->name }}</td>
        </tr>
        <tr>
            <td>Дата</td>
            <td>{{ $game->date }}</td>
        </tr>
        <tr>
            <td>Те чим гра запам'яталась</td>
            <td>{{ $game->note }}</td>
        </tr>
        <tr>
            <td>Хто був</td>
            <td>
                @forelse ($game->users as $user)
                    <p>{{ $user->name }}</p>
                @empty
                    Нікого не було або щось сталося
                @endforelse
            </td>
        </tr>
    </table>
    <a href="{{url()->previous()}}"><button type="button" class="btn btn-default">Назад</button></a>
</div>
@endsection