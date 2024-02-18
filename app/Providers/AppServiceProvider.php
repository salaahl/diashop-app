<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Votre lien de vérification')
                ->line('Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse électronique.')
                ->action('Vérifier mon email', $url)
                ->line('Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.');
        });
    }
}
