<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $fillable = [
        'bucket_id',
        'name'
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
        return $this->belongsTo(\App\Models\Bucket::class,'bucket_id' , 'id');
    }
}
