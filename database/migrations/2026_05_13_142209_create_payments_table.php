<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('order_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('payment_method', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->string('provider', 50)->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('status', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->dateTimeTz('paid_at')->nullable();
            $table->text('note')->nullable();
            $table->timestampsTz();
        });

        /*
        |--------------------------------------------------------------------------
        | CHỈNH SỬA BƯỚC 2: TẠO TRIGGER CHO BẢNG PAYMENTS
        |--------------------------------------------------------------------------
        | Mục đích chung:
        | - Tự động cập nhật trạng thái đơn hàng trong bảng orders.
        | - Trạng thái đơn hàng được cập nhật dựa trên tổng tiền payment SUCCESS.
        | - Không khai báo khóa ngoại trong migration này.
        */
        $this->createPaymentTriggers();
    }

    public function down(): void
    {
        $this->dropPaymentTriggers();

        Schema::dropIfExists('payments');
    }

    private function createPaymentTriggers(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ai_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_au_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ad_status');

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_ai_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi INSERT payment mới.
            | - Nếu tổng SUCCESS >= grand_total thì orders.status = PAID.
            | - Nếu tổng SUCCESS > 0 nhưng chưa đủ thì orders.status = PARTIAL.
            | - Nếu chưa có SUCCESS thì orders.status = PENDING.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_ai_status
                AFTER INSERT ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = NEW.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_au_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi UPDATE payment.
            | - Tính lại trạng thái thanh toán cho order cũ và order mới nếu order_id thay đổi.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_au_status
                AFTER UPDATE ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = OLD.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');

                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = NEW.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_ad_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi DELETE payment.
            | - Tính lại trạng thái thanh toán của order bị ảnh hưởng.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_ad_status
                AFTER DELETE ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = OLD.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);

            return;
        }

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ai_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_au_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ad_status');

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_ai_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi INSERT payment mới.
            | - Cập nhật trạng thái đơn hàng theo tổng payment SUCCESS.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_ai_status
                AFTER INSERT ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = NEW.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_au_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi UPDATE payment.
            | - Tính lại trạng thái thanh toán cho order cũ và order mới nếu order_id thay đổi.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_au_status
                AFTER UPDATE ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = OLD.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');

                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = NEW.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = NEW.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_payments_ad_status
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi DELETE payment.
            | - Tính lại trạng thái thanh toán của order bị ảnh hưởng.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_payments_ad_status
                AFTER DELETE ON payments
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET status = CASE
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) >= grand_total THEN 'PAID'
                        WHEN COALESCE((
                            SELECT SUM(amount)
                            FROM payments
                            WHERE order_id = OLD.order_id
                              AND status = 'SUCCESS'
                        ), 0) > 0 THEN 'PARTIAL'
                        ELSE 'PENDING'
                    END
                    WHERE order_id = OLD.order_id
                      AND status NOT IN ('CANCELLED', 'REFUNDED');
                END
            SQL);
        }
    }

    private function dropPaymentTriggers(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite' || $driver === 'mysql' || $driver === 'mariadb') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ai_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_au_status');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_payments_ad_status');
        }
    }
};