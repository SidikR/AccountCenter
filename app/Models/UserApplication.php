<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserApplication extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_auth_application';

    protected $guarded = ['id_auth_application'];

    public function user_list_akun(): BelongsTo
    {
        return $this->belongsTo(UserDetails::class, 'email', 'email');
    }
}
