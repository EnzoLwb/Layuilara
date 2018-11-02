<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('region_name', 100)->comment('地区名称');
            $table->integer('parent_id', false, true)->comment('上级地区id')->default(0);
            $table->tinyInteger('sort_order', false, true)->comment('地区显示顺序')->default(255);
            $table->tinyInteger('layer', false, true)->comment('地区层级数')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
