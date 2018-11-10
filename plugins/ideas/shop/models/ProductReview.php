<?php

namespace Ideas\Shop\Models;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Model;

class ProductReview extends Model
{
    protected $table = 'ideas_product_reviews';


    /**
     * Add review Data
     */
    public static function addReviewData($formData, $loggedIn)
    {
        $productReview = new ProductReview();
        $productReview->customer_id  = 0;
        if (!empty($loggedIn)) {
            $productReview->customer_id = $loggedIn->id;
        }
        $productReview->product_id = $formData['product_id'];
        $productReview->author = $formData['author'];
        $productReview->content = $formData['content'];
        $productReview->rate = !empty($formData['rate']) ? $formData['rate'] : 1;
        $productReview->status = IdeasShop::ENABLE;
        $productReview->save();
    }

    /**
     * Add num count review
     */
    public static function addNumCountReview($productId)
    {
        $product = Products::find($productId);
        $numReviewCount = $product->review_count;
        Products::where('id', $productId)->update(['review_count'=>$numReviewCount+1]);
    }

    /**
     * Add review point average
     */
    public static function addReviewPointAverage($productId)
    {
        $data = self::select('rate')->where('product_id', $productId)
            ->get();
        $count = 0;
        $point = 0;
        foreach ($data as $row) {
            $point += $row->rate;
            $count++;
        }
        $averagePoint = round($point/$count);
        Products::where('id', $productId)->update(['review_point'=>$averagePoint]);
    }

    /**
     * Add review
     */
    public static function addReview($formData, $loggedIn)
    {
        DB::beginTransaction();
        try {
            self::addReviewData($formData, $loggedIn);
            self::addNumCountReview($formData['product_id']);
            self::addReviewPointAverage($formData['product_id']);
            DB::commit();
            return IdeasShop::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            return IdeasShop::FAIL;
        }

    }
}