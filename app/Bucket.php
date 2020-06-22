<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    public $fillable = [
        "name",
        "color"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "name" => "required"
    ];

    public function bucket_reference()
    {
        return $this->hasMany(\App\Models\Item::class,'bucket_id' , 'id');
    }
}
