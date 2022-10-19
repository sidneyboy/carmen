<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residents extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'nickname',
        'dob',
        'place_of_birth',
        'sex',
        'nationality',
        'father',
        'mother',
        'civil_status',
        'pwd',
        'pwd_description',
        'latitude',
        'longitude',
        'resident_image',
        'status',
        'permanent_address',
        'current_address',
        'zone',
        'occupation',
        'sub_zone',
        'relationship_to_household_head',
        'senior_citizen',
    ];

    public function father_data()
    {
        return $this->belongsTo('App\Models\Residents', 'father');
    }

    public function mother_data()
    {
        return $this->belongsTo('App\Models\Residents', 'mother');
    }

    public function complain_has_one()
    {
        return $this->hasOne('App\Models\Complain', 'id','complain_status')->orderBy('id','desc');
    }
    
}
