<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isi_Faktur extends Model
{
    use HasFactory;

    protected $table = 'isi_fakturs';

    protected $fillable = [
        'id_faktur',
        'id_vendor',
        'nama_barang',
        'banyak_unit',
        'garansi',
        'lokasi',
        'status_list',
        'jatuh_tempo',
    ];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'id_faktur');
    }

    public function vendor()
    {
        return $this->belongsTo(List_Vendor::class, 'id_vendor');
    }
}
