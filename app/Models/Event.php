<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode_akses',
        'institusi',
        'tujuan_tes',
        'total_peserta',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'is_expired',
        'is_answers_hold',
        'is_institution_hold',
        'collab_logo_name',
        'collab_url',
    ];

    function scopeGetEvent($query, $accessCode)
    {
        $event = $query->where('kode_akses', '=', $accessCode)
            ->first();

        return $event;
    }

    function scopeExpiredEvent($query)
    {
        $event = $query->where('is_expired', '=', true);
        return $event;
    }

    function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }
}
