<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{

    protected $table = 'houses';

    use HasFactory;

    protected $guarded = [''];


    public function civilian()
    {
        return $this->belongsTo(Civillian::class);
    }
}
