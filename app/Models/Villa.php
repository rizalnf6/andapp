<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaVilla',
        'namaOwner',
        'alamatOwner',
        'contactOwner',
        'passportDetails',
        'passportPhoto',
        'alamatVilla',
        'namaPemilikTanah',
        'sertifTanah',
        'imbPbg',
        'lisensi',
        'tglsewaTanah',
        'pbTax',
        'registeredPe',
        'landbuildStatus',
        'ossStatus',
        'signedCopy',
        'bookingCommision',
        'fixMonthlyFee',
        'agentFee',
        'otherCommision',
        'managementAgreement',
        'perusahaanAsuransi',
        'noKebijakan',
        'namaAsuransi',
        'totalAsuransi',
        'tglPembaharuanAsuransi',
        'consultantUsed',
        'listDocuments',
        'buildingSize',
        'landSize',
    ];

    protected $casts = [
        'listDocuments' => 'array',
        'passportPhoto' => 'array',
        'managementAgreement' => 'array',
    ];
}
