<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name');
                $table->string('slug')->nullable();
                $table->string('sku', 128)->nullable();
                $table->decimal('price', 15, 2)->default(0)->nullable();
                $table->decimal('price_promotion', 15, 2)->default(0)->nullable();
                $table->integer('qty')->default(0)->nullable();
                $table->integer('qty_order')->default(0)->nullable();
                $table->text('featured_image')->nullable();
                $table->text('gallery')->nullable();
                $table->tinyInteger('status');
                $table->integer('product_order')->unsigned()->nullable();
                $table->tinyInteger('product_type')->default(1);
                $table->integer('tax_class_id');
                $table->integer('review_count')->nullable()->default(0);
                $table->text('related_product')->nullable();
                $table->timestamps();
                $table->unique('slug');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_attribute',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('product_id')->unsigned();//unsigned => fk
                $table->text('short_intro')->nullable();
                $table->text('full_intro')->nullable();
                $table->text('seo_title')->nullable();
                $table->text('seo_keyword')->nullable();
                $table->text('seo_description')->nullable();
                $table->tinyInteger('is_homepage');
                $table->tinyInteger('is_featured_product');
                $table->tinyInteger('is_new');
                $table->tinyInteger('is_bestseller');
                $table->decimal('weight', 15, 2);
                $table->integer('weight_id')->unsigned();
                $table->decimal('length', 15, 2)->nullable();
                $table->decimal('width', 15, 2)->nullable();
                $table->decimal('height', 15, 2)->nullable();
                $table->integer('length_id')->unsigned();
                $table->index('product_id');//add index
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_to_category',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('product_id')->unsigned();//unsigned
                $table->integer('category_id')->unsigned();//unsigned
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
                $table->foreign('category_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_categories')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_to_filter_option',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('product_id')->unsigned();//unsigned
                $table->integer('filter_option_id')->unsigned();//unsigned
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_configurable',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('str_filter_id', 128)->nullable();
                $table->string('str_filter_option_id', 128)->nullable();
                $table->string('str_filter_option_label', 256)->nullable();
                $table->integer('pc_product_id')->unsigned()->nullable()->comment('id of product config child');
                $table->integer('product_id')->unsigned()->nullable()->comment('id of product config parent');
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_downloadable',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('product_id')->unsigned();//unsigned
                $table->string('link', 512);
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_downloadable_link',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('product_id')->unsigned();//unsigned
                $table->timestamp('start_date')->nullable();
                $table->timestamp('end_date')->nullable();
                $table->string('code', 12);
                $table->string('link', 512);
                $table->index(['code']);
            }
        );

        //use for coupon when apply for category
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_child_to_category',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('product_id')->unsigned()->comment('id of product child of configurable product');//unsigned
                $table->integer('category_id')->unsigned();//unsigned
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
                $table->foreign('category_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_categories')
                    ->onDelete('cascade');//add foreign key
            }
        );

        //product review
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_product_reviews',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->integer('product_id')->unsigned();
                $table->integer('customer_id')->unsigned()->nullable()->default(0);
                $table->string('author');
                $table->text('content');
                $table->tinyInteger('rate')->nullable()->default(1);
                $table->tinyInteger('status')->nullable()->default(IdeasShop::ENABLE);
                $table->timestamps();
                $table->foreign('product_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_product')
                    ->onDelete('cascade');//add foreign key
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_attribute');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_to_category');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_to_filter_option');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_configurable');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_child_to_category');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_downloadable');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_downloadable_link');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_product_reviews');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
