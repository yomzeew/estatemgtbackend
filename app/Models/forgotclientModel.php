<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forgotclientModel extends Model
{
    use HasFactory;
    protected $table='clientforgotpass';
    protected $primaryKey='id';
    protected $fillable=['email','otp'];
    public $timestamps = true;
}
