<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientModel extends Model
{
    use HasFactory;
    protected $table='clienttable';
    protected $primaryKey='id';
    protected $fillable=['firstname','lastname','address','state','lga','mobileno','altmobileno','email','passcode','nextofkindetails'];
    public $timestamps = true;

}
