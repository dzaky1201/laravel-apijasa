<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $fillable = [
        'nama_pemilik', 'nomor_hp', 'alamat', 'images'
    ];
}
