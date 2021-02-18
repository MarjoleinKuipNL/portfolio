<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileNames'
    ];

    /**
     * Set the user's first name.
     *
     * @param string $value
     * @return void
     */
    public function setFileNamesAttribute($value){
        $this->attributes['fileNames'] = json_encode($value);
    }
}
