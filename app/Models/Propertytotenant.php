<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propertytotenant extends Model
{
    use HasFactory;
    protected $table='propertytotenant';
    protected $primaryKey='id';
    protected $fillable=['tenant_id','property_id','rent_fees','agent_fees','agreement','total_fees','payment_status'];
    public $timestamps = true;

}

