<?php

namespace App\Http\Livewire;

use ZipArchive,File;
use Carbon\Carbon;
use Livewire\Component;
// use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Livewire\WithPagination;

class RenpyController extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Propiedades del modal
    public $showModal = false;
    public $matchSource,$matchTarget;

    // traduccion de archivos
    public $files = [], $zipName;

    // Traduccion individual
    public $traslate_source,$traslate_target,$file_name="file.rpy";

    public $listeners = [
        'getSource' => 'traslate',
        'file' => 'generateFile'
    ];

    public function mount(){
        $this->zipName = Carbon::now('America/Mexico_City');
        $this->zipName = uniqid() . '_' . $this->zipName->format('d-m-Y');
    }

    public function render(){
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

    // Sube los archivos y genera la traduccion
    public function uploadFiles(){
        $validateFile=0;

        if ($this->files) {
             // Creacion de directorios
             Storage::makeDirectory('traductions/tempFileTraslate');
             Storage::makeDirectory('traductions/fileTraduction');
             Storage::makeDirectory('traductions/dowloadFile');
            // Itera cada archivo
            foreach ($this->files as $file) {
                // Subida de archivo al servidor
                $fileName = $file->getClientOriginalName();
                if(file_exists('traductions/tempFileTraslate/'.$fileName)){
                    unlink('traductions/tempFileTraslate/'.$fileName); //si el archivo ya existe se borra
                }
                $fileTemp = $file->storeAs('traductions/tempFileTraslate', $fileName);

                //Genera traduccion del archivo
                $textFileTraslate = $this->traslateFile($fileTemp);

                // Validacion para saber si se crea o no el zip
                $validateFile = $textFileTraslate == null ? null : 1;

                // Genera archivo traducido
                if(file_exists('traductions/fileTraduction/'.$fileName)){
                    unlink('traductions/fileTraduction/'.$fileName);
                }

                // genera archivo en español
                if ($textFileTraslate != null) {
                    Storage::put('traductions/fileTraduction/'.$fileName, $textFileTraslate);
                }
            }
            Storage::deleteDirectory('traductions/tempFileTraslate');

            if ($validateFile == null && count($this->files) == 1) {
                dd('no se genero zip');
            }else{
                 // Genera el archivo zip
                 $pathFileZip = $this->dowloadFiles();

                 // Descarga el archivo zip
                 if(file_exists($pathFileZip)){
                     return response()->download($pathFileZip);
                 }

            }
        }
    }

    // Realiza la traducción del archivo
    public function traslateFile($text){
        $regexComillas = '/"([^"]*)"/';
        $textFile = Storage::get($text); //texto del archivo return
        $lastArrayEnglis=[]; //Array con extraccion de texto en ingles
        $arrayValidate=[]; //Array que contiene los textos filtrados por las validaciones
        $arrayTextSpanish=[]; //Array con extraccion de texto en español

        // se filtarn las palabras entre comillas
        $validate = preg_match_all($regexComillas, $textFile,$result);

        if ($validate == 0) {
            return null;
        }
        $lastArrayEnglis = $result[0];

        // Extrayendo datos segun validaciones
        $arrayValidate = $this->extracMatchRegex($lastArrayEnglis);

        // Traducir lineas extraidas
        $textSpanish = $this->traslateArray($arrayValidate); // Se traduce las palabras y se gusrada en la variable

        // Llenado del array con los textox traducidos al español
        foreach ($textSpanish as $value) {
            if ($value == null) {
                array_push($arrayTextSpanish ,null);
            }else{
                $text = $this->extractMatchComillas($value);
                array_push($arrayTextSpanish ,$text);
            }
        }

        // Reemplaza las frases en ingles del texto original al español
        for ($i=0; $i < count($lastArrayEnglis); $i++) {
            if ($arrayTextSpanish[$i] != null) {
                $textFile = str_replace($lastArrayEnglis[$i],$arrayTextSpanish[$i] , $textFile);
            }
        }

        // Retorna texto original traducido
        return $textFile;
    }

    // Traduccion del array
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
        // $zipFileName = 'traduction_files_'.uniqid() . '_.zip'; // Zip File Name
        $zipFileName = $this->zipName . '.zip'; // Zip File Name

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

    // Extrae las concidencias encontradas con las validaciones regex
    public function extracMatchRegex($array){
        $result =[];

        // Validacion de / diagonal
        $result = $this->extractMatchDiagonal($array);


        // Retorna el resultado
        return $result;
    }

    // Extrae las lineas que estan entre comillas de un arcivo
    public function extractMatchComillas($textFile){
        $regexComillas = '/"([^"]*)"/';

        // se filtarn las palabras entre comillas
        $validate = preg_match_all($regexComillas, $textFile,$result);
        return $validate == 0 ? '"'.$textFile.'"' : $result[0][0];
    }

    // Extrae las la linea que tiene /
    public function extractMatchDiagonal($array){
        $regexDiagonal = '/[\/]/';
        $arrayResult=[];

        foreach ($array as $item) {
            $val = preg_match($regexDiagonal, $item);
            array_push ( $arrayResult , $val == 0 ? $item : null );
        }

        return $arrayResult;
    }

}
