<?php

use App\Models\Reminder;
use App\Models\ReminderDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReminderStatusCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_status', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Reminder::class, 'reminder_id')->nullable();
            $table->foreignIdFor(ReminderDetail::class, 'reminder_detail_id')->nullable();
            $table->integer('position');
            $table->timestamp('date');
            $table->enum('type', ['apply', 'ignore']);
            $table->string('description', 255)->nullable()->default(null);
            $table->string('frequency', 25)->nullable()->default(null);
            $table->string('schedule')->nullable()->default(null);
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminder_status');
    }
}
