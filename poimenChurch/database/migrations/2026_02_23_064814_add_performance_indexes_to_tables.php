<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Compatible MySQL 5.7+ et 8.x : vérifie via INFORMATION_SCHEMA
     * avant de créer l'index pour éviter les erreurs de doublon.
     */
    private function createIndex(string $table, string $indexName, string $columns): void
    {
        $exists = DB::selectOne(
            'SELECT COUNT(*) as cnt FROM information_schema.statistics
             WHERE table_schema = DATABASE() AND table_name = ? AND index_name = ?',
            [$table, $indexName]
        );

        if (! $exists || $exists->cnt === 0) {
            DB::statement("CREATE INDEX {$indexName} ON {$table}({$columns})");
        }
    }

    private function dropIndex(string $table, string $indexName): void
    {
        $exists = DB::selectOne(
            'SELECT COUNT(*) as cnt FROM information_schema.statistics
             WHERE table_schema = DATABASE() AND table_name = ? AND index_name = ?',
            [$table, $indexName]
        );

        if ($exists && $exists->cnt > 0) {
            DB::statement("DROP INDEX {$indexName} ON {$table}");
        }
    }

    public function up(): void
    {
        // bacenta_reports
        $this->createIndex('bacenta_reports', 'idx_br_report_date', 'report_date');
        $this->createIndex('bacenta_reports', 'idx_br_report_type', 'report_type');
        $this->createIndex('bacenta_reports', 'idx_bacenta_reports_lookup', 'bacenta_id, report_date, report_type');

        // financial_transactions
        $this->createIndex('financial_transactions', 'idx_ft_transaction_date', 'transaction_date');
        $this->createIndex('financial_transactions', 'idx_ft_fiscal_year', 'fiscal_year');
        $this->createIndex('financial_transactions', 'idx_ft_category', 'category');
        $this->createIndex('financial_transactions', 'idx_ft_transaction_type', 'transaction_type');
        $this->createIndex('financial_transactions', 'idx_ft_aggregation', 'fiscal_year, category, transaction_type');
        $this->createIndex('financial_transactions', 'idx_ft_branch_year', 'branch_id, fiscal_year');
        $this->createIndex('financial_transactions', 'idx_ft_zone_year', 'zone_id, fiscal_year');

        // users
        $this->createIndex('users', 'idx_users_is_active', 'is_active');
        $this->createIndex('users', 'idx_users_deleted_at', 'deleted_at');

        // bacentas
        $this->createIndex('bacentas', 'idx_bacentas_zone_active', 'zone_id, is_active');

        // zones
        $this->createIndex('zones', 'idx_zones_branch_active', 'branch_id, is_active');

        // events
        $this->createIndex('events', 'idx_events_published_date', 'is_published, start_date');
        $this->createIndex('events', 'idx_events_featured', 'is_published, is_featured');

        // schedules
        $this->createIndex('schedules', 'idx_schedules_active_featured', 'is_active, is_featured, `order`');

        // testimonials
        $this->createIndex('testimonials', 'idx_testimonials_active_featured', 'is_active, is_featured, display_order');

        // leadership_members
        $this->createIndex('leadership_members', 'idx_leadership_active_order', 'is_active, display_order');
    }

    public function down(): void
    {
        $this->dropIndex('bacenta_reports', 'idx_br_report_date');
        $this->dropIndex('bacenta_reports', 'idx_br_report_type');
        $this->dropIndex('bacenta_reports', 'idx_bacenta_reports_lookup');

        $this->dropIndex('financial_transactions', 'idx_ft_transaction_date');
        $this->dropIndex('financial_transactions', 'idx_ft_fiscal_year');
        $this->dropIndex('financial_transactions', 'idx_ft_category');
        $this->dropIndex('financial_transactions', 'idx_ft_transaction_type');
        $this->dropIndex('financial_transactions', 'idx_ft_aggregation');
        $this->dropIndex('financial_transactions', 'idx_ft_branch_year');
        $this->dropIndex('financial_transactions', 'idx_ft_zone_year');

        $this->dropIndex('users', 'idx_users_is_active');
        $this->dropIndex('users', 'idx_users_deleted_at');

        $this->dropIndex('bacentas', 'idx_bacentas_zone_active');
        $this->dropIndex('zones', 'idx_zones_branch_active');

        $this->dropIndex('events', 'idx_events_published_date');
        $this->dropIndex('events', 'idx_events_featured');

        $this->dropIndex('schedules', 'idx_schedules_active_featured');
        $this->dropIndex('testimonials', 'idx_testimonials_active_featured');
        $this->dropIndex('leadership_members', 'idx_leadership_active_order');
    }
};
