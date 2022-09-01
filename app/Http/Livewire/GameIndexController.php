<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Status;
use App\Models\Version;
use Livewire\Component;
use App\Models\GameEngine;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameIndexController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search,$show = false,$help = false,$view,$showEditGame= false,$game;
    public $name,$description,$backgroundImage,$siteGame,$statusId,$gameEngineId;
    private $pagination = 6;

    protected $listeners =  [
        'deleteGame' => 'deleteGame'
    ];

    public function mount(){
        $this->statusId = 'Elegir';
        $this->gameEngineId = 'Elegir';
        $this->view = 1;
    }

    public function render(){
        $statuses = Status::all();
        $game_engines = GameEngine::all();
        if (strlen($this->search) > 0) {
            $games = Game::orderBy('id','desc')
            ->where('name', 'like', '%' . $this->search . '%')
            ->with('status','game_engine','versions')->paginate($this->pagination);
        }else{
            $games = Game::orderBy('id','desc')->with('status','game_engine','versions')->paginate($this->pagination);
        }

        return view('livewire.version.index', compact('games','statuses','game_engines'));
    }

    public function Store(){
        $rules = [
            'name' => 'required|unique:games|min:5',
            'description' => strlen($this->description) > 0 ? 'min:10' : '',
            'backgroundImage' => strlen($this->backgroundImage) > 0 ? 'image' : '',
            'siteGame' => strlen($this->siteGame) > 0 ? 'url' : '',
            'statusId' => 'required|not_in:Elegir',
            'gameEngineId' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'El nombre del juego es requerido',
            'name.unique' => 'Ya ahí un juego registrado con el mismo nombre',
            'name.min' => 'El nombre del producto debe tener al menos 5 caracteres',
            'description.min' => 'La descripción debe de tener al menos 10 caracteres',
            'backgroundImage.image' => 'Seleccione una imagen correcta',
            'siteGame.url' => 'La dirección url del juego esta erronea',
            'statusId.required' => 'Seleccione un estado del juego',
            'statusId.not_in' => 'Eliga un estado',
            'gameEngineId.required' => 'Seleccione un motor de juego',
            'gameEngineId.not_in' => 'Eliga un motor de juego',
        ];

        $this->validate($rules, $messages);
        $user = Auth::user();

        $game = Game::create([
            'name' => $this->name,
            'description' => $this->description,
            'download_site' => $this->siteGame,
            'status_game_id' => $this->statusId,
            'game_engine_id' => $this->gameEngineId,
            'qualification' => 5,
            'user_id' => $user->id
        ]);

        if ($this->backgroundImage) {
            $path = 'version/'.$user->username.'/'.$this->name.'/';
            if(file_exists('version')){
                if (file_exists('version/'.$user->username) == false) {
                    Storage::makeDirectory('version/'.$user->username);
                    Storage::makeDirectory('version/'.$user->username.'/'.$this->name);
                }
            }else{
                Storage::makeDirectory('version');
                Storage::makeDirectory('version/'.$user->username);
                Storage::makeDirectory('version/'.$user->username.'/'.$this->name);
            }
            $customFileName = uniqid() . '_.' . $this->backgroundImage->extension();
            $this->backgroundImage->storeAs($path, $customFileName);
            $game->background_image = $path.$customFileName;
            $game->save();
        }
        // 'background_image' => $this->backgroundImage,

        return redirect()->route('version.show.game',$game);
    }

    public function editGame($id){
        $this->game = Game::find($id);
        $this->name = $this->game->name;
        $this->description = $this->game->description;
        $this->siteGame = $this->game->download_site;
        $this->statusId = $this->game->status_game_id;
        $this->gameEngineId = $this->game->game_engine_id;
        $this->showEditGame = true;
    }

    public function updateGame(){
        $rules = [
            'description' => strlen($this->description) > 0 ? 'min:10' : '',
            'backgroundImage' => strlen($this->backgroundImage) > 0 ? 'image' : '',
            'siteGame' => strlen($this->siteGame) > 0 ? 'url' : '',
            'statusId' => 'required|not_in:Elegir',
            'gameEngineId' => 'required|not_in:Elegir'
        ];

        $messages = [
            'description.min' => 'La descripción debe de tener al menos 10 caracteres',
            'backgroundImage.image' => 'Seleccione una imagen correcta',
            'siteGame.url' => 'La dirección url del juego esta erronea',
            'statusId.required' => 'Seleccione un estado del juego',
            'statusId.not_in' => 'Eliga un estado',
            'gameEngineId.required' => 'Seleccione un motor de juego',
            'gameEngineId.not_in' => 'Eliga un motor de juego',
        ];

        $this->validate($rules, $messages);

        $this->game->update([
            'description' => $this->description,
            'download_site' => $this->siteGame,
            'status_game_id' => $this->statusId,
            'game_engine_id' => $this->gameEngineId
        ]);

        if ($this->backgroundImage) {
            $user = Auth::user();
            $path = 'version/'.$user->username.'/'.$this->game->name.'/';
            if ($this->game->background_image != null) {
                if(file_exists('storage/'.$this->game->background_image)){
                    unlink('storage/'.$this->game->background_image); //si el archivo ya existe se borra
                }
            }
            $customFileName = uniqid() . '_.' . $this->backgroundImage->extension();
            $this->backgroundImage->storeAs($path, $customFileName);
            $this->game->background_image = $path.$customFileName;
            $this->game->save();
            $this->backgroundImage ='';
        }
        $this->resetUI();
        $this->showEditGame=false;
        $this->emit('noty-primary','El juego ha sido actualizado');
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
        $this->emit('noty-primary','El juego ha sido eliminado');
    }

    public function resetUI(){
        $this->name = "";
        $this->description = "";
        $this->siteGame = "";
        $this->statusId = 'Elegir';
        $this->gameEngineId = 'Elegir';
        $this->game = "";
        $this->backgroundImage ='';
    }
}
