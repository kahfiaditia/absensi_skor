<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepSettingModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kep_setting';
    protected $guarded = [];
}
