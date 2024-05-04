<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    protected $table = 'economies';

    use HasFactory;

    protected $guarded = ['id'];

    public function civilian()
    {
        return $this->belongsTo(Civillian::class);
    }
    
}
