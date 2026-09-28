<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['nis', 'nama', 'jenis_kelamin'];

    public function kasEntries()
    {
        return $this->hasMany(KasEntry::class);
    }
}