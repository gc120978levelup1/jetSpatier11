<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\models\Document;

class Documenttrail extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id', 'approver_sequence', 'approver_user_id', 'approval_status', 'is_viewing',
    ];
    //viewing = 0;means not yet viewed
    //viewing = 1;viewing
    //approve status
    //-1 - new file and saved (be done by filer)
    // 0 - pending/on process/saved and submitted (be done by filer)
    // 1 - approved (approver)
    // 2 - disapproved (approver)
    // 3 - approver required attention/more data
    // 4 - cancelled (be done by filer)
    // 5 - case is closed/filed (archiver)

    public function setviewfornextapprover()
    {//$doctrails = $document->find($document->id)->doctrails;
        $doctrails = $this->document->find($this->document->id)->doctrails;
        $previousdoctrail = null;
        $nextdone = false;
        foreach ($doctrails as $doctrail){
            if ($nextdone == false)
            if ($previousdoctrail != null)
            if ($previousdoctrail->is_viewing == 1)
            {
                $nextdone = true;
                $previousdoctrail->is_viewing = 2;
                $doctrail->is_viewing = 1;
            }
            $previousdoctrail = $doctrail;
        }

        //initially found that all is_viewing == 0
        if (($previousdoctrail != null) && ($previousdoctrail->is_viewing == 0) && ($nextdone == false))
        {
            $doctrails[0]->is_viewing = 1;
        }

        //initially found that last viewing is 1
        if (($previousdoctrail != null) && ($previousdoctrail->is_viewing == 1) && ($nextdone == false))
        {
            $doctrails[0]->is_viewing = 2;
        }

    }

    public function isviewing()
    {
        if ($this->is_viewing == 0) return "-------";
        if ($this->is_viewing == 1) return "Viewing";
        if ($this->is_viewing == 2) return "Decided";
        return "";
    }

    public function approvalstatus()
    {
        if ($this->approval_status == -1) return "Saved";
        if ($this->approval_status == -0) return "For Review";
        if ($this->approval_status == 1) return "Approved!";
        if ($this->approval_status == 2) return "Disapproved";
        if ($this->approval_status == 3) return "Approver requires attention!";
        if ($this->approval_status == 4) return "Cancelled by filer";
        if ($this->approval_status == 5) return "Received by archiver, recepient";
        return "";
    }
    //-----------------------------------------------relationship
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function approveruser()
    {
        return $this->belongsTo(User::class,'approver_user_id','id');
    }
}
