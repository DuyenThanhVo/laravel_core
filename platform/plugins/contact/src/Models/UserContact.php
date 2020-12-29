<?php

namespace Scoris\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scoris\Contact\Models\Contact;

class UserContact extends Model
{
    use HasFactory;

    protected $table = 'users_contact';
    protected $guarded = [];
    public function contact(){
        return $this->belongsTo(Contact::class, 'contact_id');
    }
}
