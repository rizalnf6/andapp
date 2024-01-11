<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaVilla',
        'alamatVilla',
        'namaOwner',
        'alamatOwner',
        'contactOwner',
        'namaPemilikTanah',
        'sertifTanah',
        'tglsewaTanah',
        'signedCopy',
        'fixMonthlyFee',
        'agentFee',
        'bookingCommision',
        'otherCommision',
        'perusahaanAsuransi',
        'noKebijakan',
        'namaAsuransi',
        'totalAsuransi',
        'totalKebijakan',
        'tglPembaharuanAsuransi',
        'imbPbg',
        'consultantUsed',
        'lisensi',
        'listDocuments',
        'tax',
        'pbTax',
        'landbuildStatus',
        'registeredPe',
        'ossStatus',
        'registered',
        'outstandingMatters',
        'forSale'
    ];

    protected $casts = [
        'listDocuments' => 'array'
    ];
}
