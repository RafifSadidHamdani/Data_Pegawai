<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Religion;
use App\Models\Department;
use App\Models\Job;

class Employee
{


    protected $guarded = [];
    protected $dates = ['created_at', 'tanggal_lahir'];

    // public function religions(){
    //     return $this->belongsTo(Religion::class, 'id_religions', 'id');
    // }

    // public function departments(){
    //     return $this->belongsTo(Department::class, 'id_departments', 'id');
    // }

    // public function jobs(){
    //     return $this->belongsTo(Job::class, 'id_jobs', 'id');
    // }
}
