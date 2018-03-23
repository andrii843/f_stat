@extends('layouts.app')

@section('content')

    <div class="form_content col-sm-offset-3 col-sm-6">
        <h3 class="text-center">Додавання нової гри</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('ratings.create', ['game_id' => $game->id]) }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            @forelse ($game->users as $user)
                <div class="form-group">
                    <label for="{{ $user->name }}" class="col-sm-2 control-label">{{ $user->name }}</label>
                    <div class="col-sm-10">
                        <input type="number" name="footballer_{{ $user->id }}" id="{{ $user->name }}" class="form-control" value="{{ old('footballer_'.$user->id) }}">
                    </div>
                </div>
            @empty
                Футболістів немає
            @endforelse
            <input type="submit" class="btn btn-primary" value="Зберегти">
            <a href="{{url()->previous()}}"><button type="button" class="btn btn-default">Назад</button></a>
        </form>
    </div>

@endsection