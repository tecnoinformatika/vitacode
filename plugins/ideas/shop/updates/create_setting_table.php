<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateSettingTable extends Migration
{
    public function up()
    {

        //for backend and all system settings
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_config',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name');
                $table->string('slug');
                $table->text('value')->nullable();
                $table->tinyInteger('is_default')->comment('1: default, 2: plus');
                $table->unique('slug');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_routes',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('slug');
                $table->integer('entity_id')->unsigned();
                $table->tinyInteger('type')->comment('1: product, 2: category');
                $table->index('entity_id');//add index
                $table->unique('slug');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_users_extends',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->integer('user_id')->unsigned();
                $table->string('first_name', 255);
                $table->string('last_name', 255);
                $table->string('phone', 32);
                $table->string('email');
                $table->string('address', 255);
                $table->string('post_code', 40);
                $table->integer('city_id')->unsigned();
            }
        );

        //for frontend config theme
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_theme_config',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name');
                $table->string('slug');
                $table->tinyInteger('type')->comment('1:textarea, 2:image');
                $table->unique('slug');
            }
        );

        //for frontend config theme - text type
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_theme_config_text_value',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->text('value')->nullable();
                $table->integer('theme_config_id')->unsigned();
                $table->foreign('theme_config_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_theme_config');//add foreign key
            }
        );

        //for frontend config theme - gallery and image type
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_theme_config_image_detail',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255)->nullable();
                $table->string('url', 255)->nullable();
                $table->string('link', 512)->nullable();
                $table->string('title', 255)->nullable();
                $table->string('alt', 255)->nullable();
                $table->text('description')->nullable();
                $table->integer('image_order')->unsigned();
                $table->integer('theme_config_id')->unsigned();
                $table->foreign('theme_config_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_theme_config');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_document',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_config');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_routes');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_users_extends');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_theme_config');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_theme_config_text_value');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_theme_config_image_detail');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_document');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
