<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_vendor',
        'alamat_vendor',
        'no_vendor',
    ];

    public function isi_fakturs()
    {
        return $this->hasMany(Isi_Faktur::class, 'id_vendor');
    }
}