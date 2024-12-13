<?php

namespace App\Models;

use App\Models\Jawaban as ModelsJawaban;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'dimensi_kepemimpinan',
        'type1_formatted_value',
        'type2_formatted_value',
        'progress',
        'pdf_filepath',
        'pdf_original_name',
        'inconsistent_dimension'
    ];

    use HasFactory;

    public function scopeGetAnswer($query, $eventId, $userId)
    {
        $result = $query->where('event_id', '=', $eventId)
            ->where('user_id', '=', $userId)
            ->first();

        return $result;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

