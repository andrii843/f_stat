<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('index', 'show');
	}

	public function index()
    {
        $games = Game::with('ratings')->get();

        return view('games.list', compact('games'));
    }

    public function create()
    {
    	$users = User::all();
        return view('games.create', compact('users'));
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'name' => 'required',
			'note' => 'required',
			'users' => 'required'
		]);

		$game = Game::create([
			'name' => $request->name,
			'date' => $request->date,
			'note' => $request->note
		]);

		if ($request->users)
		{
			$game->users()->attach($request->users);
		}

		return redirect()->route('games.index');
    }

    public function show($id)
    {
        $game = Game::with('users')->findOrFail($id);

        return view('games.details', compact('game'));
    }

    public function edit($id)
    {
		$game = Game::with('users')->findOrFail($id);
		$users = User::all();

		$checkedIds = [];
		if (!empty($game->users)) {
			foreach ($game->users as $user) {
				array_push($checkedIds, $user->id);
			}
		}

		return view('games.edit', compact('game', 'users', 'checkedIds'));
    }

    public function update(Request $request, $id)
    {
		$this->validate($request, [
			'name' => 'required',
			'note' => 'required',
			'users' => 'required'
		]);

		$game = Game::findOrFail($id);
		$game->name = $request->name;
		$game->date = $request->date;
		$game->note = $request->note;
		$game->save();

		if ($request->users) {
			$game->users()->sync($request->users);
		}

		return redirect()->route('games.index');
    }

	public function delete($id)
	{
		$game = Game::findOrFail($id);

		return view('games.delete', compact('game'));
	}

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->users()->detach();
        $game->delete();

        return redirect()->route('games.index');
    }
}
