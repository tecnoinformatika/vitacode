<?php namespace Jesusortega\Ids\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJesusortegaIds extends Migration
{
    public function up()
    {
        Schema::create('jesusortega_ids_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('id_fabrica');
            $table->integer('pin');
            $table->integer('user_id');
            $table->integer('vinculado')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jesusortega_ids_');
    }
}
