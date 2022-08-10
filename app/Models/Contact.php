<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $table        = 'new_contacts';
    
    protected $primaryKey   = 'id';
    
    protected $fillable     = ['firstName', 'lastName', 'address', 'city', 'country', 'email', 'phone'];
    
    
    public function getDisplayName() {
        return $this->firstName . ' ' . $this->lastName;
    }
    
}
