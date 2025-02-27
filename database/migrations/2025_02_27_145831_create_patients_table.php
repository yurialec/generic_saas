<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->enum('group', ['child', 'adult', 'teen', 'elderly']);

            $table->enum('gender', ['F', 'M', 'other']);

            $table->integer('age');
            $table->string('full_name');
            $table->string('cpf', 14)->unique(); // Formato: 000.000.000-00
            $table->string('email')->unique();
            $table->string('phone', 20); // Formato: (00) 00000-0000

            // Responsável (para menores de idade)
            $table->string('guardian_name')->nullable(); // Nome do responsável
            $table->string('guardian_phone', 20)->nullable(); // Telefone do responsável

            // Contato de emergência (obrigatório para todos)
            $table->string('emergency_contact');
            $table->string('emergency_phone', 20);

            // Plano de pagamento associado (ex: "Plano Mensal Básico")
            $table->string('payment_plan')->nullable(); // Pode ser vinculado a outra tabela futuramente

            // Observações extras
            $table->text('notes')->nullable(); // Observações clínicas ou outras

            $table->timestamps();
            $table->softDeletes(); // Exclusão suave
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
