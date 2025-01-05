<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'requires_serial_number',
        'serial_number',
        'status_list',
        'jatuh_tempo',
        'harga_jual',
        'harga_beli',
    ];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'id_faktur');
    }

    public function setGaransiAttribute($value)
    {
        if (!$this->exists) {
            $this->attributes['garansi'] = Carbon::parse($value)->addYear();
        } else {
            $this->attributes['garansi'] = $value;
    }
    }
}