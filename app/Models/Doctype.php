<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docapprovalguide;
use App\Models\Document;

class Doctype extends Model
{
    use HasFactory;
    protected $fillable = [
        'description', 'form_number', 'department_id', 'emptydoclink',
    ];
    public function docapprovalguides()
    {
        return $this->hasMany(Docapprovalguide::class)->orderBy('approver_sequence','asc');
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
