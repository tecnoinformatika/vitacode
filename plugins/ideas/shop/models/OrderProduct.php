<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class OrderProduct extends Model
{
    public $table = 'ideas_order_product';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    /**
     * Belong to product
     */
    public function product()
    {
        return $this->belongsTo('Ideas\Shop\Models\Products', 'product_id', 'id');
    }

    /**
     * has one downloadable link
     */
    public function download()
    {
        return $this->hasOne('Ideas\Shop\Models\ProductDownloadable', 'product_id', 'product_id');
    }

    /**
     * belong to order
     */
    public function order()
    {
        return $this->belongsTo('Ideas\Shop\Models\Order', 'order_id', 'id');
    }

    /**
     * Get product for order
     */
    public static function getOrderProduct($id)
    {
        $data = self::where('order_id', $id)
            ->with(['product:id,product_type', 'download:product_id,link'])
            ->get()
            ->toArray();
        return $data;
    }
}