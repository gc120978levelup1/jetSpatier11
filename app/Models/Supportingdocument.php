<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class Supportingdocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'doclink', 'document_id',
    ];

    public function document()
    {
        //return $this->hasMany(Supportingdocument::class);
        return $this->belongsTo(Document::class);
    }
}

