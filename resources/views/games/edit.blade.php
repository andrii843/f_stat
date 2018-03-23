@extends('layouts.app')

@section('content')

    <div class="form_content col-sm-offset-3 col-sm-6">
        <h3 class="text-center">Редагування гри {{ $game->name }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('games.update', ['id' => $game->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">Придумай назву грі</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $game->name }}">
            </div>
            <div class="form-group">
                <label for="date">Коли вона була?</label>
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' name="date" id="date" class="form-control" value="{{ $game->date }}" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="note">Опиши її, щоб потім одразу міг згадати</label>
                <input type="text" name="note" class="form-control" id="note" value="{{ $game->note }}">
            </div>
            <div class="form-group">
                <label for="users">Вибери хто тоді був</label>
                <div class="radio">
                    @foreach ($users as $user)
                        <label>
                            <input type="checkbox" name="users[]" value="{{$user->id}}"
                                   @if($checkedIds && in_array($user->id, $checkedIds)) checked @endif
                            >{{ $user->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Зберегти">
            <a href="{{url()->previous()}}"><button type="button" class="btn btn-default">Назад</button></a>
        </form>
    </div>

@endsection