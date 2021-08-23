<?php

namespace App\Models;

use App\Traits\SportEventTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;
    use SportEventTrait;

}
