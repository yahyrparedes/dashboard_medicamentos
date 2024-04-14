<?php

use App\Models\DocumentType;
use App\Models\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('token', 250)->nullable()->default(null);
            $table->foreignIdFor(Gender::class, 'gender_id')->nullable();
            $table->foreignIdFor(DocumentType::class, 'document_type_id')->nullable();
            $table->string('document', 15)->nullable();
            $table->string('cmp', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone', 25)->nullable()->default(null);
            $table->string('ubigeo', 6)->nullable()->default(null);
            $table->boolean('is_imported')->default(false);
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
        Schema::dropIfExists('users');
    }
}
