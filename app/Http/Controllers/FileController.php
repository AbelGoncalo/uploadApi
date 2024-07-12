<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\File;
use App\Http\Resources\FileResource;
use App\Http\Requests\FileRequest;



class FileController extends Controller
{
    //Para listar todos arquivos
    public function index(){

    }

    //metodo Para lidar com o upload de arquivos.
    public function store(Request $request){

        $data = $request->all();

        $file = File::create($data);
    }

    //para realizar o processamento básico dos arquivos (por exemplo, converter formatos, extrair metadados, etc.).
    public function process(){

    }

    //mostrar detalhes de um arquivo específico.
    public function show(string $id){

        $file = File::find($id);

        if(!$file){

             return response()->json(['message'=>'user not found'], 400);
        }

        return new FileResource($file);
    }


    public function destroy(string $id){

        $file = File::findOrFail($id);
        $file->delete();

        return response()->json([], 204);
    }

    public function upload(Request $request){

        $input = $request->all();

        $ficheiro = "";
        //preparar os ficheiros para upload
        if($input['filename']){

            //preparar os ficheiros para upload
            $ficheriro = md5($input['filename']->getClientOriginalName()).'.'.$input['filename']->getClientOriginalExtension();
            
            //fazer upload dos ficheiros
            $input['filename']->storeAs('public/files',$ficheiro);

        }

        $file = File::create([
            'filename'=>$ficheriro
        ]);

        return new FileResource($file);

        //$file->save();
    }

    public function download(File $file){

        //dd($file->filename);
        return \Storage::disk('public/files')
            ->download($file->filename);
    }
}
