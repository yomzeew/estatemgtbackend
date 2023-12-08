<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class propertyModel extends Model
{
    use HasFactory;
    protected $table='propertytable';
    protected $primaryKey='id';
    protected $fillable=['client_id','client_name','property_address','category','description','rent_fees','agent_fees','agreement','images_base64'];
    public $timestamps=true;

}
