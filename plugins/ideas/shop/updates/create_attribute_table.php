<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttributeTable extends Migration
{
    public function up()
    {
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_categories',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name');
                $table->string('slug');//to be unique
                $table->integer('parent_id')->unsigned()->nullable()->default(null);
                $table->integer('nest_left')->unsigned()->nullable()->default(null);
                $table->integer('nest_right')->unsigned()->nullable()->default(null);
                $table->integer('nest_depth')->unsigned()->nullable()->default(null);
                $table->tinyInteger('status');
                $table->text('seo_title')->nullable();
                $table->text('seo_keyword')->nullable();
                $table->text('seo_description')->nullable();
                $table->text('featured_image')->nullable();
                $table->text('description')->nullable();
                $table->integer('cat_order')->unsigned()->nullable();
                $table->timestamps();
                $table->unique('slug');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_filter',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('slug')->unique();//to be unique
                $table->tinyInteger('filter_order');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_filter_option',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->string('option_value', 255)->nullable();
                $table->tinyInteger('filter_type')->comment('1: color, 2: text, 3: image');
                $table->unique('slug');
                $table->integer('filter_id')->unsigned();//unsigned => fk
                $table->integer('option_order')->unsigned();
                $table->foreign('filter_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_filter')
                    ->onDelete('cascade');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_length',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 255);
                $table->string('unit', 10);
                $table->decimal('value', 15, 2);
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_weight',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 255);
                $table->string('unit', 10);
                $table->decimal('value', 15, 2);
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_categories');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_filter');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_filter_option');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_length');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_weight');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
