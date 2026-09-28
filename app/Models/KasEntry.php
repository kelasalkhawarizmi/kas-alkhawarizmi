<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasEntry extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'minggu_ke', 'bulan', 'tahun', 'jumlah', 'tanggal_bayar'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}