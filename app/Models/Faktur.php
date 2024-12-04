<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_faktur';

    protected $fillable = [
        'no_spk',
        'tgl_sk',
        'user',
        'tgl_bast_vendor',
        'deadline_pekerjaan',
        'spk_tj_ke_vendor',
        'nomor_folder_pekerjaan',
    ];

    public function isi_fakturs()
    {
        return $this->hasMany(Isi_Faktur::class, 'id_faktur');
    }
}
