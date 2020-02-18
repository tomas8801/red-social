<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);
        
        return view('like.index', compact('likes'));
    }

    public function like($image_id) {
        //recogemos los datos del usuario
        $user = \Auth::user();

        //comprobamos si el like ya existe para no duplicarlo
        $isset_like = Like::where('image_id', $image_id)
                        ->where('user_id', $user->id)->get();
        if (count($isset_like) == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = $image_id;

            $like->save();

            return response()->json([
                        'like' => $like
            ]);
        } else {
            return response()->json([
                        'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($image_id) {
        //recogemos los datos del usuario
        $user = \Auth::user();

        //comprobamos si el like ya existe para no duplicarlo
        $like = Like::where('image_id', $image_id)
                        ->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();

            return response()->json([
                        'like' => $like,
                        'message' => 'Haz dado dislike correctamente'
            ]);
        } else {
            return response()->json([
                        'message' => 'El like no existe'
            ]);
        }
    }

}
