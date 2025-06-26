    <?php

    use App\Models\User;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('ordenes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('token_sesion');
                $table->string('buy_order')->unique(); // código de Webpay
                $table->integer('monto_total');
                $table->string('estado')->default('pendiente'); // aprobado, rechazado, etc.
                $table->string('authorization_code')->nullable(); // respuesta de Webpay
                $table->string('payment_type_code')->nullable(); // tipo de pago (TR, CC, etc.)
                $table->string('response_code')->nullable(); // código de respuesta de Webpay
                $table->dateTime('transaction_date')->nullable(); // código de comercio de Webpay
                $table->timestamps();
            });
        }


        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('ordenes');
        }
    };
