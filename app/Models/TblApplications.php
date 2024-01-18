<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserApplication;
use App\Models\UserDetails;

class TblApplications extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_applications';

    protected $guarded = ['id_applications'];

    public function user_list()
    {
        return $this->hasMany(UserApplication::class, 'id_applications', 'id_applications');
    }
}
