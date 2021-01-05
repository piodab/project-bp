<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tactic extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'shortname',
        'description',
        'mitre_id',
        'modified',
        'created',
    ];
}
