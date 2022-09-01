<?php

namespace App\Http\Livewire;

use App\Models\Game;
use ZipArchive,File;
use App\Models\Status;
use App\Models\Version;
use Livewire\Component;
use App\Models\GameEngine;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VersionShowController extends Component
{
    use WithFileUploads;

    public $help = false,$modal_version = false,$modal_version_edit = false,$showEditGame= false;
    public $game,$versions;
    public $photo,$description;
    public $version,$comment,$file,$statusId,$statuses,$nameFolder,$editVersion;

    // Game
    public $name,$descriptionGame,$backgroundImage,$siteGame,$statusGameId,$gameEngineId;

    protected $listeners =  [
        'deleteDescription' => 'deleteDescription',
        'setNameFolder' => 'setNameFolder',
        'deleteVersion' => 'deleteVersion',
        'deleteGame' => 'deleteGame'
    ];

    public function mount($id){
        $this->game = Game::find($id);
        $this->versions = Version::where('game_id',$this->game->id)->orderBy('created_at','desc')->get();
        $this->description = $this->game->description;
        $this->statuses = Status::all();
        $this->statusId = 'Elegir';
        $this->statusGameId = 'Elegir';
    }

    public function render(){
        $game_engines = GameEngine::all();
        return view('livewire.version.show', compact('game_engines'));
    }

    public function savePhoto(){
        // $rules = [
        //     'photo' => 'required|image'
        // ];

        // $messages = [
        //     'photo.required' => 'La imagen es requerida',
        //     'photo.image' => 'Solo son adminitidos archivos de imagen',
        // ];

        // $this->validate($rules,$messages);

        $user = Auth::user();
        $path = 'version/'.$user->username.'/'.$this->game->name.'/';

        if(file_exists('storage/'.$this->game->background_image)){
            unlink('storage/'.$this->game->background_image); //si el archivo ya existe se borra
        }

        $customFileName = uniqid() . '_.' . $this->photo->extension();
        $this->photo->storeAs($path, $customFileName);
        $this->game->background_image = $path.$customFileName;
        $this->game->save();

        $this->photo ='';
        $this->emit('noty-primary','Imagen guardada');
    }

    public function like($like){
        $this->game->qualification = $like;
        $this->game->save();
        $this->emit('noty-primary','Calificación actualizada');
    }

    public function saveDescription(){
        $this->game->description = $this->description;
        $this->game->save();
        $this->description = $this->game->description;
        $this->emit('noty-primary','Descripción actualizada');
    }

    public function deleteDescription(){
        $this->game->description = null;
        $this->game->save();
        $this->description = $this->game->description;
        $this->emit('noty-danger','Descripción eliminada');
    }

    public function Store(){
        $rules = [
            'version' => 'required|min:3',
            'statusId' => 'required|not_in:Elegir',
            'comment' => strlen($this->comment) > 0 ? 'min:10' : '',
            'file' => 'required'
        ];

        $messages = [
            'version.required' => 'La versión del juego es requerida',
            'version.min' => 'La versión debe tener al menos 3 caracteres',
            'statusId.required' => 'Seleccione un estado del juego',
            'statusId.not_in' => 'Eliga un estado de la versión',
            'comment.min' => 'El comentario debe de tener al menos 10 caracteres',
            'file.required' => 'Los datos de guardado del juego son necesarios'
        ];

        $this->validate($rules, $messages);

        $user = Auth::user();
        $pathTemp = 'version/'.$user->username.'/Temp';
        $path = 'version/'.$user->username.'/'.$this->game->name.'/'.$this->version.'/';

        if(file_exists('storage/'.$path) == false) {
            Storage::makeDirectory($path);
        }

        // Se crea el directorio temp y se suben los archivos
        Storage::makeDirectory('version/'.$user->username.'/Temp');
        foreach ($this->file as $file) {
            $fileName = $file->getClientOriginalName();
            if(file_exists('storage/'.$pathTemp.'/'.$fileName)){
                unlink('storage/'.$pathTemp.'/'.$fileName); //si el archivo ya existe se borra
            }
            $file->storeAs($pathTemp, $fileName);
        }

        $files = File::files(public_path('storage/'.$pathTemp));
        $zipFileName = $this->nameFolder . '.zip'; // Zip File Name

        if(file_exists('storage' . '/'. $path. $zipFileName)){
            unlink('storage' . '/'. $path. $zipFileName); //si el archivo ya existe se borra
        }

        // Se crea el zip
        $zip = new ZipArchive;
        if ($zip->open('storage' . '/'. $path. $zipFileName, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value,$relativeName);
            }
            $zip->close();
        }
        $pathFileZip = $path. $zipFileName;
        // Se borra el directorio Temp
        Storage::deleteDirectory('version/'.$user->username.'/Temp');

        Version::create([
            'game_id' => $this->game->id,
            'version' => $this->version,
            'comment' => $this->comment,
            'file' => $pathFileZip,
            'status_id' => $this->statusId
        ]);
        $this->versions = Version::where('game_id',$this->game->id)->orderBy('created_at','desc')->get();
        $this->resetUI();
        $this->emit('noty-success','Se creó la versión correctamente');
    }

    public function Edit($id){
        $this->editVersion = Version::find($id);
        $this->version = $this->editVersion->version;
        $this->comment = $this->editVersion->comment;
        $this->statusId = $this->editVersion->status_id;
        $this->modal_version_edit = true;
    }

    public function Update(){
        $rules = [
            'version' => 'required|min:3',
            'statusId' => 'required|not_in:Elegir',
            'comment' => strlen($this->comment) > 0 ? 'min:10' : ''
        ];

        $messages = [
            'version.required' => 'La versión del juego es requerida',
            'version.min' => 'La versión debe tener al menos 3 caracteres',
            'statusId.required' => 'Seleccione un estado del juego',
            'statusId.not_in' => 'Eliga un estado de la versión',
            'comment.min' => 'El comentario debe de tener al menos 10 caracteres'
        ];

        $this->validate($rules, $messages);

        $this->editVersion->version = $this->version;
        $this->editVersion->comment = $this->comment;
        $this->editVersion->status_id = $this->statusId;

        if ($this->file) {
            $user = Auth::user();
            $pathTemp = 'version/'.$user->username.'/Temp';
            $path = 'version/'.$user->username.'/'.$this->game->name.'/'.$this->version.'/';

            if(file_exists('storage/'.$path) == false) {
                Storage::makeDirectory($path);
            }

            // Se crea el directorio temp y se suben los archivos
            Storage::makeDirectory('version/'.$user->username.'/Temp');
            foreach ($this->file as $file) {
                $fileName = $file->getClientOriginalName();
                if(file_exists('storage/'.$pathTemp.'/'.$fileName)){
                    unlink('storage/'.$pathTemp.'/'.$fileName); //si el archivo ya existe se borra
                }
                $file->storeAs($pathTemp, $fileName);
            }

            $files = File::files(public_path('storage/'.$pathTemp));
            $zipFileName = $this->nameFolder . '.zip'; // Zip File Name

            if(file_exists('storage' . '/'. $path. $zipFileName)){
                unlink('storage' . '/'. $path. $zipFileName); //si el archivo ya existe se borra
            }

            // Se crea el zip
            $zip = new ZipArchive;
            if ($zip->open('storage' . '/'. $path. $zipFileName, ZipArchive::CREATE) === TRUE) {
                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value,$relativeName);
                }
                $zip->close();
            }
            $pathFileZip = $path. $zipFileName;
            // Se borra el directorio Temp
            Storage::deleteDirectory('version/'.$user->username.'/Temp');
            $this->editVersion->file = $pathFileZip;
        }

        $this->editVersion->save();
        $this->versions = Version::where('game_id',$this->game->id)->orderBy('created_at','desc')->get();
        $this->resetUI();
        $this->emit('noty-success','Se creó la versión correctamente');

    }

    public function editGame(){
        $this->name = $this->game->name;
        $this->descriptionGame = $this->game->description;
        $this->siteGame = $this->game->download_site;
        $this->statusGameId = $this->game->status_game_id;
        $this->gameEngineId = $this->game->game_engine_id;
        $this->showEditGame = true;
    }

    public function updateGame(){
        $rules = [
            'descriptionGame' => strlen($this->descriptionGame) > 0 ? 'min:10' : '',
            'backgroundImage' => strlen($this->backgroundImage) > 0 ? 'image' : '',
            'siteGame' => strlen($this->siteGame) > 0 ? 'url' : '',
            'statusGameId' => 'required|not_in:Elegir',
            'gameEngineId' => 'required|not_in:Elegir'
        ];

        $messages = [
            'descriptionGame.min' => 'La descripción debe de tener al menos 10 caracteres',
            'backgroundImage.image' => 'Seleccione una imagen correcta',
            'siteGame.url' => 'La dirección url del juego esta erronea',
            'statusGameId.required' => 'Seleccione un estado del juego',
            'statusGameId.not_in' => 'Eliga un estado',
            'gameEngineId.required' => 'Seleccione un motor de juego',
            'gameEngineId.not_in' => 'Eliga un motor de juego',
        ];

        $this->validate($rules, $messages);

        $this->game->update([
            'description' => $this->descriptionGame,
            'download_site' => $this->siteGame,
            'status_game_id' => $this->statusGameId,
            'game_engine_id' => $this->gameEngineId
        ]);

        if ($this->backgroundImage) {
            $user = Auth::user();
            $path = 'version/'.$user->username.'/'.$this->game->name.'/';

            if(file_exists('storage/'.$this->game->background_image)){
                unlink('storage/'.$this->game->background_image); //si el archivo ya existe se borra
            }
            $customFileName = uniqid() . '_.' . $this->backgroundImage->extension();
            $this->backgroundImage->storeAs($path, $customFileName);
            $this->game->background_image = $path.$customFileName;
            $this->game->save();
            $this->backgroundImage ='';
        }

        $this->showEditGame=false;
        $this->emit('noty-primary','El juaego ha sido actualizado');
    }

    public function deleteVersion(Version $version){
        $user = Auth::user();
        $path = 'version/'.$user->username.'/'.$this->game->name.'/'.$version->version;

        if(file_exists('storage/'.$path)) {
            Storage::deleteDirectory($path);
        }

        $version->delete();
        $this->versions = Version::where('game_id',$this->game->id)->orderBy('created_at','desc')->get();
        $this->emit('noty-success','La versión se elimino correctamente');
    }

    public function resetUI(){
        $this->modal_version_edit = false;
        $this->modal_version = false;
        $this->editVersion = "";
        $this->version = "";
        $this->comment = "";
        $this->file = "";
        $this->statusId = "Elegir";
        $this->nameFolder = "";
        $this->resetValidation(); //limpia los mensajes de validacion
    }

    public function setNameFolder($name){
        $this->nameFolder = strlen($name) > 0 ? $name : 'saves';
    }

    public function dowloadVersion($id){
        $version = Version::find($id);
        if(file_exists('storage/'.$version->file)) {
            return response()->download('storage/'.$version->file);
        }else {
            $this->emit('noty-danger','El archivo no existe');
        }


    }

    public function deleteGame(Game $game){
        $versions = Version::where('game_id',$game->id)->get();
        $user = Auth::user();
        $path = 'version/'.$user->username.'/'.$game->name;

        DB::beginTransaction();
        try {
            foreach ($versions as $item) {
                $item->delete();
            }
            if(file_exists('storage/'.$path)){
                Storage::deleteDirectory($path);
            }
            $game->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->emit('noty-danger','Ups!! Hubo un error al eliminar el juego');
            return $e->getMessage();
        }

        return redirect()->route('version');
    }

}
