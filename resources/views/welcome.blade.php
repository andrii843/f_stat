@extends('layouts.app')

@section('content')
   <div class="row text-center">
       <h2>Footstat - statistics fot football teams</h2>
   </div>
    <div class="content">
        <table class="table">
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}<td>
                    <td>{{ $user->email }}<td>
                    <td>{{ $user->average_rating }}<td>
                    <td>{{ $user->count_rating }}<td>
                </tr>
            @empty
                <p>Поки ще ніхто не зареєструвався</p>
            @endforelse
        </table>
    </div>
@endsection
