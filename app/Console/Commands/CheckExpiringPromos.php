<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckExpiringPromos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expiring-promos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expiring promos...');

        // 1. Promos expiring in 7 days
        $promos7Days = \App\Models\Promo::whereDate('end_date', now()->addDays(7)->toDateString())
            ->where('is_active', true)
            ->get();

        foreach ($promos7Days as $promo) {
            $this->notifyTenant($promo, 7);
        }

        // 2. Promos expiring in 3 days
        $promos3Days = \App\Models\Promo::whereDate('end_date', now()->addDays(3)->toDateString())
            ->where('is_active', true)
            ->get();

        foreach ($promos3Days as $promo) {
            $this->notifyTenant($promo, 3);
        }

        $this->info('Done.');
    }

    private function notifyTenant($promo, $days)
    {
        $tenantUsers = \App\Models\User::where('tenant_id', $promo->tenant_id)->get();
        $notificationService = new \App\Services\NotificationService();

        foreach ($tenantUsers as $user) {
            $notificationService->create(
                $user,
                'promo_expiring',
                'Promo Expiring Soon',
                "Your promo '{$promo->name}' will expire in {$days} days.",
                ['promo_id' => $promo->id],
                route('tenant.promo.edit', $promo->uuid)
            );
        }

        // Notify Admins
        $adminUsers = \App\Models\User::role('admin')->get();
        foreach ($adminUsers as $admin) {
            $notificationService->create(
                $admin,
                'promo_expiring',
                'Tenant Promo Expiring',
                "Promo '{$promo->name}' from tenant '{$promo->tenant->name}' will expire in {$days} days.",
                ['promo_id' => $promo->id, 'tenant_id' => $promo->tenant_id],
                route('admin.promo.edit', $promo->uuid)
            );
        }
    }
}
