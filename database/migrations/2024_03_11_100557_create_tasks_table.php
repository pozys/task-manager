<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'tasks';

    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->comment('Название задачи');
            $table->string('description')
                ->nullable()
                ->comment('Описание задачи');
            $table->foreignId('task_status_id')
                ->index()
                ->comment('Статус задачи')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('created_by_id')
                ->index()
                ->comment('Создатель задачи')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('assigned_to_id')
                ->index()
                ->comment('Исполнитель задачи')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
