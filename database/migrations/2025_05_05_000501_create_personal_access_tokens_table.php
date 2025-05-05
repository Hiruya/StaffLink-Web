    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Support\Facades\Schema;
    use MongoDB\Laravel\Schema\Blueprint;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('personal_access_tokens', function (Blueprint $collection) {
                $collection->string('tokenable_type');
                $collection->uuid('tokenable_id');
                $collection->string('name');
                $collection->string('token', 64)->unique();
                $collection->text('abilities')->nullable();
                $collection->timestamp('last_used_at')->nullable();
                $collection->timestamp('expires_at')->nullable();
                $collection->timestamps();

                $collection->index(['tokenable_type', 'tokenable_id']);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('personal_access_tokens');
        }
    };
