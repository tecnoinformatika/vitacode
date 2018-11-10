<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Coupon;
use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateCouponTable extends Migration
{
    public function up()
    {
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_coupon',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->string('code', 255);
                $table->tinyInteger('type')->comment('1: percentage, 2: fixed amount');
                $table->tinyInteger('logged')->comment('need customer logged in ? 0: no, 1: yes');
                $table->decimal('discount', 15, 2)->nullable();
                $table->decimal('total', 15, 2)->nullable()
                    ->comment('total amount that has to be reached before the coupon is valid');
                $table->timestamp('start_date')->nullable()->comment('coupon is valid from this date');
                $table->timestamp('end_date')->nullable()->comment('coupon is valid to this date');
                $table->integer('num_uses')->default(0)->comment('number times this coupon can be used');
                $table->integer('num_per_customer')->nullable()
                    ->comment('number times single customers can use for this coupon');
                $table->tinyInteger('status');
                $table->tinyInteger('is_for_all')->default(Coupon::IS_FOR_ALL)->comment('0:not for all, 1: for all');
                $table->timestamps();
            }
        );

        //to know how many times coupon used, and how many customers use this coupon
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_coupon_history',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->integer('coupon_id')->unsigned();//fk
                $table->integer('order_id')->unsigned();//fk
                $table->integer('customer_id')->unsigned();//fk
                $table->decimal('total', 15, 2)->nullable();
                $table->timestamps();
                $table->foreign('coupon_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_coupon')
                    ->onDelete('cascade');//add foreign key
                $table->foreign('order_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_coupon_to_product',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('coupon_id')->unsigned();//unsigned
                $table->integer('product_id')->unsigned();//unsigned
                $table->foreign('coupon_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_coupon')
                    ->onDelete('cascade');//add foreign key
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_coupon_to_category',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('coupon_id')->unsigned();//unsigned
                $table->integer('category_id')->unsigned();//unsigned
                $table->foreign('coupon_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_coupon')
                    ->onDelete('cascade');//add foreign key
                $table->foreign('category_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_categories')
                    ->onDelete('cascade');//add foreign key
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_coupon');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_coupon_history');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_coupon_to_product');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_coupon_to_category');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}

