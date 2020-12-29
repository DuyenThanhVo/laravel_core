<?php

namespace Scoris\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scoris\Contact\Models\UserContact;
use Scoris\Contact\Models\ContactCategory;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user_contact(){
        return $this->hasMany(UserContact::class, 'contact_id');
    }

    public function contact_cat(){
        return $this->belongsTo(ContactCategory::class, 'contact_cat_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('h:i d/m/Y');
    }
}

