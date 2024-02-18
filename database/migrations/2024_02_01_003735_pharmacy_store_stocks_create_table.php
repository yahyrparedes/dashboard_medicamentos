<?php

use App\Models\Medication;
use App\Models\PharmacyStore;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PharmacyStoreStocksCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies_store_stock', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignIdFor(Medication::class, 'medication_id')->nullable();
            $table->foreignIdFor(PharmacyStore::class, 'pharmacies_store_id')->nullable();
            $table->string('stock');
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
        Schema::dropIfExists('pharmacies_store_stock');
    }
}
