<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Vet;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class VetController extends Controller
{
    public function index(Request $request){
        $vets= Vet::all();
        return view('vet.view')->with(compact('vets'));
    }

    public function create(){
        return view('vet.create_vet');
    }

    public function save(Request $request){
        $vet = new Vet();
        $name= $request->input('name');
        $image= $request->file('image_path');

        $vet->name=$name;

        if($image){
            $image_path_name = time().$image->getClientOriginalName();

            Storage::disk('vets')->put($image_path_name, File::get($image));

            $vet->image = $image_path_name;
        }

        $vet->save();
        return redirect()->route('home');

        
    }

    public function avatar($file){
        $imagen = Storage::disk('vets')->get($file);
        return new Response($imagen,200);
    }
}
