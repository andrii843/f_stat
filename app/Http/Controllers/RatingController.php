<?php

namespace App\Http\Controllers;

use App\Game;
use App\Rating;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except('index', 'gameRating');
	}

	public function index()
    {
        $data = Rating::with('user')->with('game')->get();
        dump($data);
        $ratings = [];
        foreach ($data as $value) {
			$ratings[] = [
        		'ratings' => unserialize($value['ratings']),
				'user' => $value->user->name,
				'game' => $value->game->name
			];
		}

        return view('ratings.list', compact('ratings'));
    }

	public function gameRating($gameId)
	{
		$game = Game::with('users')->findOrFail($gameId);
		$gameRatings = Rating::where('game_id', $gameId)->get();

		$users = $game->users->keyBy('id');

		$ratings = [];
		foreach ($gameRatings as $value) {
			$rating = unserialize($value->ratings);
			foreach ($rating as $userId => $rat) {
				$ratings[$userId] = isset($ratings[$userId]) ? ($ratings[$userId] + (double)$rat) / 2 : (double)$rat;
			}
		}

		return view('ratings.game', compact('ratings', 'game', 'users'));
	}

	public function gameRatingUser($gameId, $userId)
	{
//		$game = Game::with('users')->findOrFail($gameId);
//		$gameRatings = Rating::where('game_id', $gameId)->where('user_id', '<>', $userId)->get();
//
//		$users = $game->users->keyBy('id');
//
//		$ratings = [];
//		foreach ($gameRatings as $value) {
//			$rating = unserialize($value->ratings);
//			foreach ($rating as $user_Id => $rat) {
//				if ($userId != $user_Id)
//					continue;
//				$ratings[$userId] = isset($ratings[$user_Id]) ? ($ratings[$user_Id] + (double)$rat) / 2 : (double)$rat;
//			}
//		}

		return view('ratings.game', compact('ratings', 'game', 'users'));
	}

    public function add($gameId)
    {
		$game = Game::with('users')->findOrFail($gameId);

		$userId = Auth::id();

		if (Rating::where('game_id', $gameId)->where('user_id', $userId)->get()->isNotEmpty()) {
			return back()->with('alert', "You have already added ratings for game as {$game->name}");
		}

		return view('ratings.add', compact('game'));
    }

    public function create(Request $request, $gameId)
    {
    	$gameRatings = $request->except('_token');

		Validator::make($gameRatings, [
			'*' => 'required|numeric|between:0,10'
		])->validate();

		$newGameRatings = [];
		foreach ($gameRatings as $key => $value) {
			$newKey = substr($key, strlen('footballer_'));
			$newGameRatings[$newKey] = $value;
		}

		$game = Game::with('users')->findOrFail($gameId);

		$rating = new Rating([
			'ratings' => serialize($newGameRatings)
		]);
		$rating->user()->associate(Auth::user());
		$rating->game()->associate($game);
		$rating->save();

		foreach ($newGameRatings as $userId => $rat) {
			$user = User::find($userId);
			$user->average_rating = $user->average_rating != 0 ? ($user->average_rating + (double)$rat) / 2 : (double)$rat;
			$user->count_rating++;
			$user->save();
		}

		return redirect()->route('ratings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
