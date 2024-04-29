<?php

declare(strict_types=1);

use App\Enums\Booking\Category;
use App\Enums\Booking\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('events', static function (Blueprint $table): void {
            $table->uuid('id')->primary();

            $table->string('summary');
            $table->string('timezone')->default('UTC');
            $table->string('status')->default(Status::Confirmed->value);
            $table->string('category')->default(Category::Personal->value);

            $table->text('description')->nullable();
            $table->json('location')->nullable();
            $table->json('repeat_rule')->nullable();

            $table
                ->foreignUuid('calendar_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignUuid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
