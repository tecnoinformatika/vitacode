<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Updates\Migration;

class removeCityPostCode extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists(IdeasShop::TABLE_PREFIX.'_city');
        Schema::table(IdeasShop::TABLE_PREFIX.'_order', function ($table) {
            $table->dropColumn('billing_city_id');
            $table->dropColumn('billing_post_code');
            $table->dropColumn('shipping_city_id');
            $table->dropColumn('shipping_post_code');
        });
        Schema::table(IdeasShop::TABLE_PREFIX.'_users_extends', function ($table) {
            $table->dropColumn('post_code');
            $table->dropColumn('city_id');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down()
    {

    }
}