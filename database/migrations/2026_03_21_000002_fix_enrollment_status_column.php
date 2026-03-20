<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('enrollments')) {
            return;
        }

        if (!Schema::hasColumn('enrollments', 'order_code')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->string('order_code')->nullable()->after('course_id');
            });
        }

        if (!Schema::hasColumn('enrollments', 'status')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->tinyInteger('status')
                    ->default(0)
                    ->comment('0 chưa thanh toán, 1 đã thanh toán')
                    ->after('enrollment_date');
            });

            return;
        }

        DB::statement("
            UPDATE enrollments
            SET status = CASE
                WHEN LOWER(CAST(status AS CHAR)) IN ('1', 'paid', 'active', 'approved', 'success', 'successful') THEN '1'
                ELSE '0'
            END
        ");

        DB::statement("
            ALTER TABLE enrollments
            MODIFY status TINYINT(1) NOT NULL DEFAULT 0
            COMMENT '0 chưa thanh toán, 1 đã thanh toán'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Không rollback kiểu cột cũ vì không xác định được schema trước đó.
    }
};
