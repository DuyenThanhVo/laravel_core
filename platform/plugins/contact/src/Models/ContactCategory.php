<?php

namespace Scoris\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Scoris\Contact\Models\Contact;

class ContactCategory extends Model
{
    use HasFactory;

    protected $table = 'contact_categories';

    protected $guarded = [];

    public function contact()
    {
        return $this->hasMany(Contact::class, 'contact_cat_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('h:i d/m/Y');
    }
}
