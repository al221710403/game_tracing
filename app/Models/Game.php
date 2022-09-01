<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'background_image',
        'download_site',
        'status_game_id',
        'game_engine_id',
        'qualification',
        'user_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class,'status_game_id');
    }

    public function game_engine(){
        return $this->belongsTo(GameEngine::class,'game_engine_id');
    }

    public function versions(){
        return $this->hasMany(Version::class);
    }

    public function getImageAttribute(){
        $image = $this->background_image;
        if($image == null){
            return 'noimg.png';
        }else{
            if(file_exists('storage/' . $image)){
                return $image;
            }else{
                return 'noimg.png';
            }
        }
    }

}
