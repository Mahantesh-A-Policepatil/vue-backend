<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmUser extends Model
{
    use HasFactory;

    // by default the table name would be "crm_users" which matches our migration

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'department',
        'city',
    ];
}
