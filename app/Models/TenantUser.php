<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    use HasFactory;
    protected $table='tenanttable';
    protected $primaryKey='id';
    protected $fillable=['firstname','lastname','address','state','lga','mobileno','altmobileno','email','passcode','occupation','status','nextofkindetails'];
    public $timestamps = true;
}
