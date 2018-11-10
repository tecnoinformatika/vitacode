<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateOrderTable extends Migration
{

    public function up()
    {
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order_status',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 128);
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->integer('user_id')->unsigned()->nullable();
                $table->string('billing_name', 128);
                $table->string('billing_address', 128);
                $table->integer('billing_city_id')->nullable();
                $table->string('billing_email', 128);
                $table->string('billing_phone', 32);
                $table->string('billing_post_code', 40)->nullable();
                $table->string('shipping_name', 128);
                $table->string('shipping_address', 128);
                $table->integer('shipping_city_id')->nullable();
                $table->string('shipping_email', 128);
                $table->string('shipping_phone', 32);
                $table->string('shipping_post_code', 40)->nullable();
                $table->integer('shipping_rule_id');
                $table->integer('payment_method_id')->comment('1: Cod; 2:paypal, 3:Stripe');
                $table->text('comment')->nullable();
                $table->decimal('shipping_cost', 15, 2);
                $table->decimal('total', 15, 2);
                $table->integer('order_status_id')->unsigned();
                $table->tinyInteger('payment_status')->comment('0: not paid; 1: paid');
                $table->timestamps();
                $table->foreign('order_status_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order_status');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order_product',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('order_id')->unsigned();//for fk
                $table->integer('product_id')->unsigned();
                $table->string('name', 512);
                $table->integer('qty')->unsigned();
                $table->decimal('price_after_tax', 15, 2);
                $table->decimal('total', 15, 2);
                $table->decimal('weight', 15, 2);
                $table->tinyInteger('weight_id');
                $table->foreign('order_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order_status_change',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('order_id')->unsigned();
                $table->integer('order_status_id')->unsigned();
                $table->text('comment')->nullable();
                $table->timestamps();
                $table->foreign('order_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order_return_reason',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_order_return',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('order_id')->unsigned();
                $table->integer('product_id')->unsigned();
                $table->string('product_name', 512);
                $table->integer('customer_id')->unsigned();
                $table->string('billing_name', 255);
                $table->string('shipping_name', 255);
                $table->string('billing_phone', 32);
                $table->string('billing_email');
                $table->string('shipping_phone', 32);
                $table->string('shipping_email');
                $table->integer('reason_id')->unsigned();
                $table->integer('qty_order')->unsigned();
                $table->tinyInteger('is_reverse_order_qty')->default(IdeasShop::ENABLE)->nullable()
                    ->comment('1: reverse order quantity, 0: not reverse');
                $table->timestamps();
                $table->foreign('order_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order');//add foreign key
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product');//add foreign key
                $table->foreign('reason_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_order_return_reason');//add foreign key
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order_status');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order_product');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order_status_change');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order_return');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_order_return_reason');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
