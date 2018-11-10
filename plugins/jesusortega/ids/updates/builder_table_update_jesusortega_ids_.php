<?php namespace Jesusortega\Ids\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJesusortegaIds extends Migration
{
    public function up()
    {
        Schema::table('jesusortega_ids_', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->renameColumn('user_id', 'producto_id');
        });
    }
    
    public function down()
    {
        Schema::table('jesusortega_ids_', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->renameColumn('producto_id', 'user_id');
        });
    }
}
