<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MpArtworkCategory;
use App\Models\MpArtworkGenre;
use App\Models\MpArtworkTag;
use App\Models\Film;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $tags = MpArtworkTag::all(); 
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }       
        $film = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "'.$user_id.'" AND film_id = films.id ),0) as is_favorited')
        )->where('home', 1)->first();
        return view('home', compact('film','categories', 'genres', 'tags'));
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $tags = MpArtworkTag::all(); 
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }       
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "'.$user_id.'" AND film_id = films.id ),0) as is_favorited'))
            ->where('films.film_original_title', 'LIKE', '%'.$search.'%')
            ->orwhere('films.film_country_of_origin', 'LIKE', '%'.$search.'%')
            ->orwhere('films.film_tagline', 'LIKE', '%'.$search.'%')
            ->orwhere('films.film_synopsis', 'LIKE', '%'.$search.'%')
            ->orwhere('films.film_pros', 'LIKE', '%'.$search.'%')
            ->orwhere('films.film_cons', 'LIKE', '%'.$search.'%')
        ->get();
        return view('search', compact('search', 'films','categories', 'genres', 'tags'));
    }
}
