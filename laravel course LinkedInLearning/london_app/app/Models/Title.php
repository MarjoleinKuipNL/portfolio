<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReadOnlyBase;

class Title extends ReadOnlyBase
{
    use HasFactory;
    protected $titles_array = ['mrs','miss','dr', 'mx'];
}
