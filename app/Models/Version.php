<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;
    protected $table = 'game_versions';

    protected $fillable = [
        'game_id',
        'version',
        'comment',
        'file',
        'status_id'
    ];

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

}
