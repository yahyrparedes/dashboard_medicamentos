<?php

use App\Models\Department;
use App\Models\District;
use App\Models\Pharmacy;
use App\Models\Province;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PharmacyStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies_store', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('code')->unique();
            $table->string('description');
            $table->string('format');
            $table->foreignIdFor(Pharmacy::class, 'pharmacy_id')->nullable();
            $table->string('type');
            $table->string('address');
            $table->boolean('is_active')->default(true);
            $table->foreignIdFor(Department::class, 'department_id')->nullable();
            $table->foreignIdFor(Province::class, 'province_id')->nullable();
            $table->foreignIdFor(District::class, 'district_id')->nullable();
            $table->string('opening_date')->nullable();
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
        Schema::dropIfExists('pharmacies_store');
    }
}
