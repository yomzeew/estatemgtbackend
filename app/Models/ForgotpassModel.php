<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotpassModel extends Model
{
    use HasFactory;
    protected $table='forgotpassword';
    protected $primaryKey='id';
    protected $fillable=['email','otp'];
    public $timestamps = true;
}
