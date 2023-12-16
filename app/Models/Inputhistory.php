<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inputhistory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'input_history';
}
