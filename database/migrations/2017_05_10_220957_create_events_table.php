<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_type_id')->unsigned()->default(0);
            $table->integer('group_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('last_updated_by')->unsigned()->default(0);
            $table->integer('event_page_id')->unsigned()->default(0);

            $table->string('title', 50);
            $table->string('description');
            $table->boolean('allDay')->nullable();
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->string('url')->nullable();
            $table->string('className')->nullable();
            $table->boolean('editable')->nullable();
            $table->boolean('startEditable')->nullable();
            $table->boolean('durationEditable')->nullable();
            $table->boolean('recourceEditable')->nullable();
            $table->string('rendering', 18)->nullable();
            $table->boolean('overlap')->nullable();
            $table->integer('constraint')->nullable();
            $table->string('source')->nullable();
            $table->string('color', 30)->nullable();
            $table->string('backgroundColor', 30)->nullable();
            $table->string('borderColor', 30)->nullable();
            $table->string('textColor', 30)->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
