<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use UuidModel, SoftDeletes;

    public $table = 'products';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_description',
        'price',
        'discount_price',
        'product_status',
        'stock',
        'category_id',
        'image_id',
        'last_modified_by',
        'deleted_by',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_status' => 'boolean'
    ];

    public static function sql()
    {
        return self::leftJoin('categories', 'products.category_id', 'categories.id')
            ->select(
                'products.*',
                'categories.id as id_category',
                'products.id as id',
                'categories.name as category_name'
            );
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
