<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civillian extends Model
{
    protected $table = 'civilians';

    use HasFactory;

    protected $guarded = ['id'];

    public function economy()
    {
        return $this->belongsTo(Economy::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
