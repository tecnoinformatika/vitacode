<?php namespace Ideas\Shop\Models;

use Carbon\Carbon;
use October\Rain\Database\Model;
use Mail;

class ProductDownloadableLink extends Model
{
    public $table = 'ideas_product_downloadable_link';

    /**
     * check code is not expire
     */
    public static function checkLinkIsNotExpire($code)
    {
        //dd(date('Y-m-d H:i:s'));
        $data = self::where('code', $code)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->where('end_date', '>=', date('Y-m-d H:i:s'))
            ->first();
        $link = '';
        if (!empty($data)) {
            return $data->link;
        }
        return $link;
    }

    /**
     * Send download link to customer
     * params include:
     * + email: email of customer who get downloadable product
     * + productId : product id
     * + link: link of this product
     */
    public static function sendDownloadLink($params)
    {
        $email = $params['email'];
        $productId = $params['productId'];
        $link = $params['link'];
        $tomorrow = Carbon::now()->addDay()->toDateTimeString();
        $code = IdeasShop::generateRandomString(12);
        $data = [
            'product_id' => $productId,
            'start_date' => date('Y-m-d H:i:s'),
            'end_date' => $tomorrow,
            'code' => $code,
            'link' => $link
        ];
        self::insert($data);
        $url = url('/download?code='.$code);
        $data = ['url'=>$url];
        $params = [
            'email' => $email,
            'name' => '',
            'subject' => 'ideas.shop::lang.subject.send_download_link',
            'data' => $data,
            'template' => 'ideas.shop::mail.downloadableProductLink'
        ];
        IdeasShop::sendMail($params);
        if (count(Mail::failures()) > 0) {
            return IdeasShop::FAIL;
        } else {
            // Mail sent
            return IdeasShop::SUCCESS;
        }
    }

}
