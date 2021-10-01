<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctype;
use App\Models\Supportingdocument;
use App\Models\Documenttrail;
use App\Models\Docapprovalguide;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'doclink', 'filer_user_id', 'archiver_user_id','doctype_id', 'approval_status',
    ];

//--------------------------------------- named relationships ------------------------------------------
    public function filer_user()
    {
        return $this->belongsTo(User::class,'filer_user_id','id');
    }

    public function archiver_user()
    {
        return $this->belongsTo(User::class,'archiver_user_id','id');
    }

    public function doctype()
    {
        return $this->belongsTo(Doctype::class);
    }

    public function supportdocs()
    {
        return $this->hasMany(Supportingdocument::class);
    }

    public function doctrails()
    {
        return $this->hasMany(Documenttrail::class);
    }

//--------------------------------------------------- Actions --------------------------------
    //viewing = 0;means not yet viewed
    //approve status
    //-1 - new file and saved (be done by filer)
    // 0 - pending/on process/saved and submitted (be done by filer)
    // 1 - approved (approver)
    // 2 - disapproved (approver)
    // 3 - approver required attention/more data
    // 4 - cancelled (be done by filer)
    // 5 - case is closed/filed (archiver)

    public function approvalstatus()
    {
        if ($this->approval_status == -1) return "Saved";
        if ($this->approval_status == -0) return "Submitted, On-process";
        if ($this->approval_status == 1) return "Approved!";
        if ($this->approval_status == 2) return "Disapproved";
        if ($this->approval_status == 3) return "Approver requires attention!";
        if ($this->approval_status == 4) return "Cancelled by filer";
        if ($this->approval_status == 5) return "Closed by archiver, recepient";
    }

    public function generatedoctrails()
    {
        $doctrailcount = $this->find($this->id)->doctrails->count();
        if ($doctrailcount > 0) return -1; //exit if already have doctrail data, proceed otherwise
        $doctype_id = $this->doctype->id;
        $docapprovalguides = $this->doctype->find($doctype_id)->docapprovalguides;
        $count = 0;
        foreach ($docapprovalguides as $docapprovalguide)
        {
            $doctrail = new Documenttrail;
            $doctrail->document_id = $this->id;
            $doctrail->approver_sequence = $docapprovalguide->approver_sequence;
            $doctrail->approver_user_id = $docapprovalguide->approver_user_id;
            $doctrail->approval_status = 0; //for approval status
            if ($count == 0){
                $doctrail->is_viewing = 1; //not yet viewed
            }else{
                $doctrail->is_viewing = 0; //not yet viewed
            }
            $doctrail->save(); //insert to database
            $count++;
        }
        $doctrail = new Documenttrail;
        $doctrail->document_id = $this->id;
        $doctrail->approver_sequence = 100;
        $doctrail->approver_user_id = $this->archiver_user_id;
        $doctrail->approval_status = 0; //for approval status
        if ($count == 0){
            $doctrail->is_viewing = 1; //not yet viewed
        }else{
            $doctrail->is_viewing = 0; //not yet viewed
        }
        $doctrail->save(); //insert to database
        return 0;
    }

}
