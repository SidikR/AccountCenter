<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Opd;

class UserDetails extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_user_details';

    protected $guarded = ['id_user_details'];

    public function opdDetail()
    {
        return $this->belongsTo(Opd::class, 'id_opds', 'id_opds');

        // return $this->hasOne(Opd::class, 'id_opds', 'id_opds');
        // return $this->hasOne(UserDetails::class, 'email');
    }
}
