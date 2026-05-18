<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->unsignedBigInteger('booking_room_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('booking_service_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('order_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->text('note')->nullable();
            $table->decimal('quantity', 10, 2)->default(1);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('line_total', 12, 2)->default(0);
            $table->timestampTz('created_at')->useCurrent();
        });

        /*
        |--------------------------------------------------------------------------
        | CHỈNH SỬA BƯỚC 2: TẠO TRIGGER CHO BẢNG ORDER_DETAILS
        |--------------------------------------------------------------------------
        | Mục đích chung:
        | - Tự động tính line_total = quantity * unit_price.
        | - Tự động cập nhật subtotal và grand_total trong bảng orders.
        | - Không khai báo khóa ngoại trong migration này.
        */
        $this->createOrderDetailTriggers();
    }

    public function down(): void
    {
        $this->dropOrderDetailTriggers();

        Schema::dropIfExists('order_details');
    }

    private function createOrderDetailTriggers(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ai_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_au_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ad_sync');

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_ai_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi INSERT vào order_details.
            | - Tự tính line_total cho dòng vừa thêm.
            | - Tính lại subtotal và grand_total của đơn hàng liên quan.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_ai_sync
                AFTER INSERT ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE order_details
                    SET line_total = COALESCE(NEW.quantity, 0) * COALESCE(NEW.unit_price, 0)
                    WHERE order_detail_id = NEW.order_detail_id;

                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0)
                    WHERE order_id = NEW.order_id;
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_au_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi UPDATE order_details.
            | - Tự tính lại line_total khi quantity/unit_price thay đổi.
            | - Tính lại subtotal và grand_total cho đơn hàng cũ và mới.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_au_sync
                AFTER UPDATE ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE order_details
                    SET line_total = COALESCE(NEW.quantity, 0) * COALESCE(NEW.unit_price, 0)
                    WHERE order_detail_id = NEW.order_detail_id
                      AND line_total <> COALESCE(NEW.quantity, 0) * COALESCE(NEW.unit_price, 0);

                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0)
                    WHERE order_id = OLD.order_id;

                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0)
                    WHERE order_id = NEW.order_id;
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_ad_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi DELETE khỏi order_details.
            | - Tính lại subtotal và grand_total của đơn hàng bị ảnh hưởng.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_ad_sync
                AFTER DELETE ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0)
                    WHERE order_id = OLD.order_id;
                END
            SQL);

            return;
        }

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_bi_calc');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_bu_calc');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ai_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_au_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ad_sync');

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_bi_calc
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy trước khi INSERT vào order_details.
            | - Tự động tính line_total = quantity * unit_price.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_bi_calc
                BEFORE INSERT ON order_details
                FOR EACH ROW
                BEGIN
                    SET NEW.line_total = COALESCE(NEW.quantity, 0) * COALESCE(NEW.unit_price, 0);
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_bu_calc
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy trước khi UPDATE order_details.
            | - Tự động tính lại line_total khi quantity/unit_price thay đổi.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_bu_calc
                BEFORE UPDATE ON order_details
                FOR EACH ROW
                BEGIN
                    SET NEW.line_total = COALESCE(NEW.quantity, 0) * COALESCE(NEW.unit_price, 0);
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_ai_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi INSERT vào order_details.
            | - Tự động tính lại subtotal và grand_total trong orders.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_ai_sync
                AFTER INSERT ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0)
                    WHERE order_id = NEW.order_id;
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_au_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi UPDATE order_details.
            | - Tự động tính lại subtotal và grand_total cho order cũ và order mới.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_au_sync
                AFTER UPDATE ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0)
                    WHERE order_id = OLD.order_id;

                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = NEW.order_id
                        ), 0)
                    WHERE order_id = NEW.order_id;
                END
            SQL);

            /*
            |--------------------------------------------------------------------------
            | TRIGGER: trg_order_details_ad_sync
            |--------------------------------------------------------------------------
            | Tác dụng:
            | - Chạy sau khi DELETE khỏi order_details.
            | - Tự động tính lại subtotal và grand_total của order bị ảnh hưởng.
            */
            DB::unprepared(<<<'SQL'
                CREATE TRIGGER trg_order_details_ad_sync
                AFTER DELETE ON order_details
                FOR EACH ROW
                BEGIN
                    UPDATE orders
                    SET subtotal = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0),
                        grand_total = COALESCE((
                            SELECT SUM(COALESCE(quantity, 0) * COALESCE(unit_price, 0))
                            FROM order_details
                            WHERE order_id = OLD.order_id
                        ), 0)
                    WHERE order_id = OLD.order_id;
                END
            SQL);
        }
    }

    private function dropOrderDetailTriggers(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite' || $driver === 'mysql' || $driver === 'mariadb') {
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_bi_calc');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_bu_calc');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ai_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_au_sync');
            DB::unprepared('DROP TRIGGER IF EXISTS trg_order_details_ad_sync');
        }
    }
};