<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactperson extends Model
{
    use HasFactory;
    protected $table ="contact_persons";
    protected $fillable=
    ['FirstName' ,'LastName','Company','Email','Phone','LinkdinProfileURL'];


    public function company(){
        return $this->belongsTo(company::class,'Company');
    }

}
