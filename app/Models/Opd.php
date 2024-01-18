<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDetails;;

class Opd extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_opds';

    protected $guarded = ['id_opds'];

    public function user_list_opd()
    {
        // return $this->hasMany(UserDetails::class, 'id_opds');
        return $this->hasMany(UserDetails::class, 'id_opds', 'id_opds');
    }
}
