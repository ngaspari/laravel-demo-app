<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table    = 'countries';

    public $timestamps  = false;

    protected $fillable = ['name', 'code'];
    
    
    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}