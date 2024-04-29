<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('groups', static function (Blueprint $table): void {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();

            $table
                ->foreignUuid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
