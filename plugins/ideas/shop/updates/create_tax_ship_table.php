<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\IdeasShop;
use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class CreateTaxShipTable extends Migration
{
    public function up()
    {
        Schema::create(
            IdeasShop::TABLE_PREFIX.'_geo_zone',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->text('description')->nullable();
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_city',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->integer('geo_zone_id')->unsigned();//unsigned => fk
                $table->foreign('geo_zone_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_geo_zone');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_currency',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->string('code', 10);
                $table->string('symbol', 10);
                $table->tinyInteger('symbol_position')->comment('0: before, 1: after');
                $table->float('value', 15, 8)->nullable();
                $table->timestamp('date_modified')->nullable();
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_ship_rule',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->decimal('above_price', 15, 2)->nullable();
                $table->integer('geo_zone_id')->unsigned()->nullable();
                $table->tinyInteger('weight_type')->nullable()->comment('1:fixed, 2:rate');
                $table->string('weight_based', 512)->nullable();
                $table->decimal('cost', 15, 2)->nullable();
                $table->tinyInteger('type')
                    ->comment('1: price, 2: geo, 3: weight based, 4: per item, 5: geo weight based');
                $table->tinyInteger('status');
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_tax_class',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name', 255);
                $table->text('description')->nullable();
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_tax_rate',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');//primary key, unsigned(10), index
                $table->string('name', 255);
                $table->tinyInteger('type')->comment('1: percentage, 2: fixed amount');
                $table->integer('geo_zone_id')->unsigned();// for fk
                $table->decimal('rate', 15, 2);
                $table->foreign('geo_zone_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_geo_zone');//add foreign key
            }
        );

        Schema::create(
            IdeasShop::TABLE_PREFIX.'_tax_rule',
            function ($table) {
                $table->engine = 'InnoDB';
                $table->integer('tax_class_id')->unsigned();// for fk
                $table->integer('tax_rate_id')->unsigned();// for fk
                $table->foreign('tax_class_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_tax_class');//add foreign key
                $table->foreign('tax_rate_id')
                    ->references('id')->on(IdeasShop::TABLE_PREFIX.'_tax_rate');//add foreign key
            }
        );
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_geo_zone');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_currency');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_ship_rule');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_tax_class');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_tax_rate');
        Schema::drop(IdeasShop::TABLE_PREFIX.'_tax_rule');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
