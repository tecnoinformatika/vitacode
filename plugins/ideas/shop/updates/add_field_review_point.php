<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;

class AddFieldReviewPoint extends Migration
{
    public function up()
    {
        Schema::table(IdeasShop::TABLE_PREFIX.'_product', function ($table) {
            $table->tinyInteger('review_point')->nullable()->default(0)->comment('review point average');
        });
    }

    public function down()
    {
        Schema::table(IdeasShop::TABLE_PREFIX.'_product', function ($table) {
            $table->dropColumn('review_point');
        });
    }

}
