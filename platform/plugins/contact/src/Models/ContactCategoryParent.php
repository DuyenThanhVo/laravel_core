<?php

namespace Scoris\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCategoryParent extends Model
{
    use HasFactory;

    protected $table = 'contact_categories_parent';

    protected $guarded = [];
}
