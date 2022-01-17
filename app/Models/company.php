<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $fillable=['Name','Email','logo','Website_URL'];

    public function getLogoUrlAttribute(){
        
        return asset('storage/'.$this->logo);

    }
}
