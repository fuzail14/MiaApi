<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{


    use HasFactory;



    protected $fillable = [
        "residentid",
        "subadminid",
        "country",
        "state",
        "city",
        "societyid",
        "phaseid",
        "blockid",
        "streetid",
        "houseid",
        "houseaddress",
        "vechileno",
        "residenttype",
        "propertytype",
        "committeemember",
    ];
}
