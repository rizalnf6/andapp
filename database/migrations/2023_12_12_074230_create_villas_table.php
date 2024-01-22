<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('namaVilla');
            $table->string('alamatVilla');
            $table->string('namaOwner');
            $table->string('alamatOwner');
            $table->string('contactOwner');
            $table->string('passportDetails');
            $table->string('passportPhoto');
            $table->string('namaPemilikTanah');
            $table->string('sertifTanah');
            $table->date('tglsewaTanah');
            $table->enum('signedCopy', ['Yes', 'No']);
            $table->enum('fixMonthlyFee', ['Yes', 'No']);
            $table->string('agentFee');
            $table->string('bookingCommision');
            $table->string('otherCommision');
            $table->string('perusahaanAsuransi');
            $table->string('noKebijakan');
            $table->string('namaAsuransi');
            $table->string('totalAsuransi');
            $table->string('totalKebijakan');
            $table->date('tglPembaharuanAsuransi');
            $table->string('imbPbg');
            $table->string('consultantUsed');
            $table->string('lisensi');
            $table->string('listDocuments');
            $table->string('tax');
            $table->string('pbTax');
            $table->string('landbuildStatus');
            $table->enum('registeredPe', ['Yes', 'No']);
            $table->string('ossStatus');
            $table->string('registered');
            $table->string('outstandingMatters');
            $table->enum('forSale', ['Yes', 'No']);
            $table->string('managementAgreement');
            $table->string('buildingSize');
            $table->string('landSize');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
