<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Denuncia;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DenunciasController extends Controller{
    
    public function index(){
        $denuncias = Denuncia::where('estado', 1)->orderBy("titulo")->get();
	    
	    return $denuncias;
    }
    
    //Registro de Denuncia
    public function store(Request $request){
        try{
            if(!$request->has('titulo') || !$request->has('descripcion') || !$request->has('ubicacion')){
                throw new \Exception('Campos mandatorios');
            }
            
            $denuncia = new Denuncia();
            $denuncia->titulo = $request->get('titulo');
            $denuncia->users_id = $request->get('users_id');
    		$denuncia->descripcion = $request->get('descripcion');
    		$denuncia->ubicacion = $request->get('ubicacion');
    		$denuncia->estado = '1';
    		
    		if($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
        		$imagen = $request->file('imagen');
        		$filename = $request->file('imagen')->getClientOriginalName();
        		
        		Storage::disk('images')->put($filename,  File::get($imagen));
        		
        		$denuncia->imagen = $filename;
    		}
    		
    		$denuncia->save();
    	    
    	    return response()->json(['type' => 'success', 'message' => 'Registro completo'], 200);
    	    
        }catch(\Exception $e){
            return response()->json(['type' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

}
