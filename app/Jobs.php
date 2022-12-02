<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table ="jobs";
    protected $primaryKey="JOB_ID";

    public function employees(){

      return $this->hasMany(Employee::class,'JOB_ID','JOB_ID');  
    }
}
