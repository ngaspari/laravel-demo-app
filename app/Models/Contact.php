<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $table        = 'contacts';
    
    protected $primaryKey   = 'id';
    
    protected $fillable     = ['firstName', 'lastName', 'address', 'city', 'email', 'phone'];
    
    
    public function getDisplayName() {
        return $this->firstName . ' ' . $this->lastName;
    }
    
    
    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault([
            'id'    => null,
            'name'  => null,
        ]);;
    }
    
}
