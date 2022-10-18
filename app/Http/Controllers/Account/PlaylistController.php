<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPlaylist;
use App\Models\MpArtworkCategory;
use App\Models\MpArtworkGenre;
use App\Models\MpArtworkTag;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    /**
     * Show Profile View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_name = 'playlist';
        $user_id = Auth::user()->id;
        $playlist = UserPlaylist::join('films', 'films.id', 'user_playlists.film_id', 'left')->where('user_id',$user_id)->orderby('user_playlists.created_at', 'desc')->paginate(12);
        $categories = MpArtworkCategory::get();
        $genres = MpArtworkGenre::get();
        $tags = MpArtworkTag::all();
        return view('accounts.playlist.index', compact('page_name', 'playlist', 'categories', 'genres', 'tags'));
    }
    public function favorite(Request $request)
    {
        $user_id = Auth::user()->id;
        UserPlaylist::where('user_id', $user_id)->where('film_id', $request->film_id)->delete();
        if ($request->active == 1) {
            $new = UserPlaylist::create([
                'user_id' => $user_id,
                'film_id' => $request->film_id,
            ]);
            return true;
        }
        return false;
    }
}
