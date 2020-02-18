<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }
    
    public function update(Requests\UpdateUserRequest $request){
        // conseguir usuario logeado
        $user = \Auth::user();
        
        // asignar nuevos valores al objeto user
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nick = $request->input('nick');
        $user->email = $request->input('email');
        
        // subir imagen al servidor
        $image_path = $request->file('image_path');
        if ($image_path) {
            // le ponemos un nombre unico a la imagen que nos llega
            $image_path_name = time().$image_path->getClientOriginalName();
            // guardamos en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // seteamos el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        $user->update();
        return redirect()->route('config')->with(['message' => 'El usuario se actualizó correctamente']);
    }
    
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile($id){
        $user = User::find($id);
        
        return view('user.profile', compact('user'));
    }
    
    public function users($search = null){
        if (!empty($search)) {
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('surname', 'LIKE', '%'.$search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        
        
        
        return view('user.index', compact('users'));
    }
}
