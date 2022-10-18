<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\MpArtworkCategory;
use App\Models\MpArtworkGenre;
use App\Models\MpArtworkTag;
use Illuminate\Support\Facades\Auth;
use DB;
class TagController extends Controller
{
    public function index()
    {
        $tag_id = 0;
        $tags = MpArtworkTag::all();
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "'.$user_id.'" AND film_id = films.id ),0) as is_favorited')
        )->get();
        return view('tag.index', compact('tags', 'categories',  'genres', 'films', 'tag_id'));
    }

    public function showFilm($tag_id)
    {
        $tags = MpArtworkTag::all();
        $categories = MpArtworkCategory::all();
        $genres = MpArtworkGenre::all();
        $user_id = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }
        $films = Film::select(
            'films.*',
            DB::raw('COALESCE((SELECT COUNT(user_playlists.id) FROM user_playlists WHERE user_id = "'.$user_id.'" AND film_id = films.id ),0) as is_favorited')
        )->where('film_tag', 'like', "%$tag_id%")->get();
        return view('tag.index', compact('tags', 'categories',  'genres', 'films', 'tag_id'));
    }
}
