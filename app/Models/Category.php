<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
	//public $timestamps = false;//To disable timestamps
    /**
     * Explicit table name example
     * Otherwise it assumes that the table name is the plural form 
     * of the model name and in this case for Item model the table name should be items. 
     */
    //protected $table = 'tbl_categories'; in case your table name convention is different

    /*I does guard your model attributes. Only these you define in $fillable will be updated in database, 
	except for id, updated_at, created_at.*/
    protected $fillable=[
        'name',
        'description',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
