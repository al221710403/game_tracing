<?php

namespace App\Http\Livewire;

use ZipArchive,File;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Livewire\WithPagination;

class RenpyController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $files = [];
    public $traslate_source,$traslate_target,$file_name="file.rpy";

    public $listeners = [
        'getSource' => 'traslate',
        'file' => 'generateFile'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.renpy')->extends('layouts.app')
            ->section('content');
    }

    public function traslate($textTraslate){
        $arrayResult=[];
        $tr = new GoogleTranslate('es');
        foreach ($textTraslate as $item) {
            if ($item == null) {
                array_push ( $arrayResult , null );
            }else{
                $val = $tr->translate($item);
                array_push ( $arrayResult , $val );
            }
        }
        // dd($arrayResult);
        // $arrayResult=['"{i}Toc, toc.{/i}"','Alguien está en la puerta.','"¿Estás instalado?"'];
        //dd($textTraslate,$arrayResult);
        $this->emit('result_traslate',$arrayResult);
    }

    public function generateFile($textFile){
        // $file = fopen('ejemplo1.txt','a+') or die("error al intentar crear archivo");
        // fwrite($file,'Texto de prueba');
        if(file_exists('traductions/'.$this->file_name)){
            unlink('traductions/'.$this->file_name);
        }
        Storage::put('traductions/'.$this->file_name , $textFile);
        return Storage::download('traductions/'.$this->file_name);
    }

    public function uploadFiles(){
        // $traslate=[];
        if ($this->files) {
            foreach ($this->files as $file) {
                // Creacion de directorios
                Storage::makeDirectory('traductions/tempFileTraslate');
                Storage::makeDirectory('traductions/fileTraduction');
                Storage::makeDirectory('traductions/dowloadFile');

                // Subida de archivo al servidor
                $fileName = $file->getClientOriginalName();
                if(file_exists('traductions/tempFileTraslate/'.$fileName)){
                    unlink('traductions/tempFileTraslate/'.$fileName);
                }
                $fileTemp = $file->storeAs('traductions/tempFileTraslate', $fileName);

                //Genera traduccion del archivo
                $textFileTraslate = $this->traslateFile($fileTemp);

                // Genera archivo traducido
                if(file_exists('traductions/fileTraduction/'.$fileName)){
                    unlink('traductions/fileTraduction/'.$fileName);
                }
                Storage::put('traductions/fileTraduction/'.$fileName, $textFileTraslate);
            }
            Storage::deleteDirectory('traductions/tempFileTraslate');
            $pathFileZip = $this->dowloadFiles();

            if(file_exists($pathFileZip)){
                return response()->download($pathFileZip);
            }
        }
    }

    public function traslateFile($text){
        $regexComillas = '/"([^"]*)"/';
        $textFile = Storage::get($text); //texto del archivo return
        $lastArrayEnglis=[]; //Array con extraccion de texto en ingles
        $arrayTextSpanish=[]; //Array con extraccion de texto en español

        preg_match_all($regexComillas, $textFile,$result); // se filtarn las palabras entre comillas
        $lastArrayEnglis=$result[0]; //Se guarda el resultado del filtro

        // dd($lastArrayEnglis);

        $textSpanish = $this->traslateArray($lastArrayEnglis); // Se traduce las palabras y se gusrada en la variable

        // dd($textSpanish);

        foreach ($textSpanish as $value) {
            $validate = preg_match_all($regexComillas, $value,$r); // Se filtra de nuevo las palabras en comillas
            if ($validate == 0) {
                array_push($arrayTextSpanish ,'"'.$value.'"'); // el resultado se guarda en el array
            } else {
                array_push($arrayTextSpanish ,$r[0][0]); // el resultado se guarda en el array
            }
        }

        // dd($arrayTextSpanish);

        for ($i=0; $i < count($lastArrayEnglis); $i++) {
            $textFile = str_replace($lastArrayEnglis[$i],$arrayTextSpanish[$i] , $textFile);
        }

        return $textFile;
    }


    public function traslateArray($array){
        $arrayResult =[];
        $tr = new GoogleTranslate('es');
        foreach ($array as $item) {
            if ($item == null) {
                array_push ( $arrayResult , null );
            }else{
                $val = $tr->translate($item);
                array_push ( $arrayResult , $val );
            }
        }

        return $arrayResult;
    }

    public function dowloadFiles(){
        $zip = new ZipArchive; // Create ZipArchive Obj
        $zipFileName = 'traduction_files_'.uniqid() . '_.zip'; // Zip File Name

        if ($zip->open(public_path('storage/traductions/dowloadFile/'.$zipFileName), ZipArchive::CREATE) == TRUE) {
            // Add File in ZipArchive
            $files = File::files(public_path('storage/traductions/fileTraduction'));
            if (count($files) > 0) {

                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value,$relativeName);
                }
                $zip->close();

                Storage::deleteDirectory('traductions/fileTraduction');

                $pathFileZip = public_path('storage/traductions/dowloadFile/'.$zipFileName);

                while ($zip->status == 0) {
                    if(file_exists($pathFileZip)) {
                        return $pathFileZip;
                    }
                }
            }
        }

        return null;


    }

}
