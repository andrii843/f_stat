@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <h2>Ratings</h2>
    </div>
    <div class="content">
        <table class="table">
            @forelse($ratings as $rating)
                <tr>
                    <td>{{ $rating['game'] }}<td>
                    <td>{{ $rating['user'] }}<td>
                    <td>
                    @foreach($rating['ratings'] as $key => $value)
                        <p>{{ $key }}: {{ $value }}</p>
                    @endforeach
                    </td>
                </tr>
            @empty
                <p>Поки ще ніхто немає ігор</p>
            @endforelse
        </table>
    </div>
@endsection
