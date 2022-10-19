<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = [
        'complainant',
        'respondent',
        'reason',
        'complain_status',
    ];

    public function complainant_data()
    {
        return $this->belongsTo('App\Models\Residents', 'complainant');
    }

    public function respondent_data()
    {
        return $this->belongsTo('App\Models\Residents', 'respondent');
    }
}
