<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Http\Responses\RegisterResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
        if (env(key: 'APP_ENV') === 'local' && request()->server(key: 'HTTP_X_FORWARDED_PROTO') === 'https') {
            URL::forceScheme(scheme: 'https');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            return $user->hasRole('superuser') ? true : null;
        });

        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Login::class,
            \App\Listeners\LoginListener::class
        );
        Schema::defaultStringLength(191);

        if (app()->bound('db') && Schema::hasTable('settings')) {
            $mailSetting = \App\Models\Setting::where('pages', 'mail')->where('is_active', true)->first();
            if ($mailSetting && is_array($mailSetting->payload)) {
                $payload = $mailSetting->payload;
                config([
                    'mail.mailers.smtp.transport' => $payload['mail_mailer'] ?? config('mail.mailers.smtp.transport'),
                    'mail.mailers.smtp.host'      => $payload['mail_host'] ?? config('mail.mailers.smtp.host'),
                    'mail.mailers.smtp.port'      => $payload['mail_port'] ?? config('mail.mailers.smtp.port'),
                    'mail.mailers.smtp.username'  => $payload['mail_username'] ?? config('mail.mailers.smtp.username'),
                    'mail.mailers.smtp.password'  => $payload['mail_password'] ?? config('mail.mailers.smtp.password'),
                    'mail.mailers.smtp.encryption'=> $payload['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
                    'mail.from.address'           => $payload['mail_from_address'] ?? config('mail.from.address'),
                    'mail.from.name'              => $payload['mail_from_name'] ?? config('mail.from.name'),
                    'mail.hr_notification_email'  => $payload['hr_notification_email'] ?? env('HR_NOTIFICATION_EMAIL'),
                ]);
            }
        }

        \Illuminate\Support\Facades\View::composer(
            [
                'frontend.partials.footer_v2',
                'frontend.directory.index',
                'frontend.promotion.index',
                'frontend.new-store.index',
                'backend.admin.dashboard.index'
            ],
            \App\Http\View\Composers\StatsComposer::class
        );

        \Illuminate\Support\Facades\View::composer(
            [
                'landing_v2',
                'frontend.gallery.index',
                'frontend.career.index',
                'frontend.career.show',
                'frontend.directory.index',
                'frontend.promotion.index',
                'frontend.new-store.index',
                'frontend.event.index',
                'frontend.event.detail',
                'frontend.dining.index',
                'frontend.tenant.index',
                'frontend.tenant.index_new',
                'frontend.partials._sidebar',
                'frontend.partials.footer_v2'
            ],
            \App\Http\View\Composers\FrontendMenuComposer::class
        );

        // Global listener to log all sent emails
        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Mail\Events\MessageSent::class,
            function (\Illuminate\Mail\Events\MessageSent $event) {
                try {
                    $recipients = collect($event->message->getTo())->map(fn($addr) => $addr->toString())->implode(', ');
                    $subject = $event->message->getSubject();
                    $body = $event->message->getHtmlBody() ?: $event->message->getTextBody();
                    
                    \App\Models\EmailLog::create([
                        'recipient' => $recipients,
                        'subject' => $subject,
                        'body' => $body,
                        'status' => 'sent',
                    ]);
                } catch (\Exception $e) {
                    logger()->error('Failed to log sent email: ' . $e->getMessage());
                }
            }
        );
    }
}
