<?php

namespace Scoris\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactParent extends Model
{
    use HasFactory;
    protected $table = 'contacts_parent';

    protected $guarded = [];
}
