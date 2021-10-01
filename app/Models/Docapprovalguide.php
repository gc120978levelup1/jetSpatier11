<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Doctype;
use app\Models\User;

class Docapprovalguide extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctype_id', 'approver_sequence', 'approver_user_id',
    ];

    public function doctype()
    {
        return $this->belongsTo(Doctype::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class,'approver_user_id','id');
    }
}

