@extends('layouts.app')

@section('content')
    <div class="form-content row">
        <form action="{{ route('games.destroy', ['id' => $game->id]) }}" method="post" class="col-sm-6 col-sm-offset-3">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="form-group">
                <h3>Ви дійсно бажаєте видалити гру <b>{{ $game->name }}</b></h3>
            </div>
            <button type="submit" class="btn btn-danger">Підтвердити</button>
            <a href="{{url()->previous()}}"><button type="button" class="btn btn-default">Назад</button></a>
        </form>
    </div>
@endsection