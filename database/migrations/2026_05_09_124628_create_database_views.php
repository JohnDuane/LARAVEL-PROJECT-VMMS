<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_customer_vehicles AS
            SELECT
                customer.id AS customer_id,
                customer.first_name,
                customer.middle_name,
                customer.last_name,
                vehicle.vehicle_id,
                vehicle.plate_number,
                vehicle.make,
                vehicle.engine_model
            FROM customer
            JOIN vehicle
                ON customer.id = vehicle.customer_id
        ");

        DB::statement("
            CREATE OR REPLACE VIEW view_joborder_parts AS
            SELECT
                jo.job_order_id,
                p.part_name,
                jp.quantity
            FROM job_order_parts jp
            JOIN job_order jo
                ON jp.job_order_id = jo.job_order_id
            JOIN part p
                ON jp.part_id = p.part_id
        ");

        DB::statement("
            CREATE OR REPLACE VIEW view_job_order AS
            SELECT
                jo.job_order_id,

                CONCAT(
                    c.first_name,
                    ' ',
                    COALESCE(c.middle_name, ''),
                    ' ',
                    c.last_name
                ) AS cust_name,

                v.plate_number,
                s.staff_name AS mechanic_name,
                jo.created_at,
                jo.status,
                jo.date_issued,
                jo.total_cost,
                v.make

            FROM job_order jo

            JOIN customer c
                ON jo.customer_id = c.id

            JOIN vehicle v
                ON jo.vehicle_id = v.vehicle_id

            JOIN staff s
                ON jo.staff_id = s.staff_id
        ");

        DB::statement("
            CREATE OR REPLACE VIEW view_part_stock AS
            SELECT
                p.part_id,
                p.part_name,
                p.price,
                COALESCE(SUM(s.quantity_received), 0) AS stock
            FROM part p
            LEFT JOIN stockin s
                ON p.part_id = s.part_id
            GROUP BY
                p.part_id,
                p.part_name,
                p.price
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_customer_vehicles');
        DB::statement('DROP VIEW IF EXISTS view_joborder_parts');
        DB::statement('DROP VIEW IF EXISTS view_job_order');
        DB::statement('DROP VIEW IF EXISTS view_part_stock');
    }
};