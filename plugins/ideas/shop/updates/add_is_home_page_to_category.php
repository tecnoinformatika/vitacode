<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;

class AddIsHomePageToCategory extends Migration
{
    public function up()
    {
        Schema::table(IdeasShop::TABLE_PREFIX.'_categories', function ($table) {
            $table->tinyInteger('is_homepage')->comment('0: no, 1:yes');
            $table->integer('num_display')->default(4)->nullable();
        });
    }

    public function down()
    {
        Schema::table(IdeasShop::TABLE_PREFIX.'_categories', function ($table) {
            $table->dropColumn('is_homepage');
            $table->dropColumn('num_display');
        });
    }

}
