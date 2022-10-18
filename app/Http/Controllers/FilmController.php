<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\MpArtworkCategory;
use App\Models\MpArtworkGenre;
use App\Models\MpArtworkTag;
use Illuminate\Support\Facades\Auth;
use DB;
class FilmController extends Controller
{
    public function index()
    {
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }    
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "'.$user_id.'" AND film_id = films.id ),0) as is_favorited')
        )->get();
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $tags = MpArtworkTag::all();
        return view('film.index', compact('categories', 'genres', 'tags', 'films'));
    }
}
