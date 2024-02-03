<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            -> subject('Verificar Cuenta DevJobs')
            -> line('Tu cuenta ya esta casi lista ! , solo preciona el enlace a continuación...')
            -> action('Presiona para crear Cuenta aqui !!!', $url)
            -> line('Si no creaste esta cuenta en DevJobs, ignora este mensaje...');
        });
    }
}
