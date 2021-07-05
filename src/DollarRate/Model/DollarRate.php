<?php

namespace Src\DollarRate\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DollarRate extends Model
{
    use HasFactory;

    protected $table = 'tasas_dolar';
}
