<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //
    protected $table = "tb_anggota";
    protected $primaryKey = "id";
    protected $guarded=[];
}
