<?php
namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

use App\Models\EmailSetting;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        /***** Set Email Configuration *****/
        $emailSetting = EmailSetting::first();
        if ($emailSetting) {
            $emailConfig = array(
                'driver'     => $emailSetting->transport,
                'transport'  => $emailSetting->transport,
                'host'       => $emailSetting->host,
                'port'       => $emailSetting->port,
                'from'       => array('address' => $emailSetting->from_email, 'name' => $emailSetting->from_name),
                'encryption' => ($emailSetting->encryption) ? $emailSetting->encryption : null,
                'username'   => $emailSetting->username,
                'password'   => $emailSetting->password,
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
                'timeout'    => null,
                'auth_mode'  => null,
            );
            
            Config::set('mail', $emailConfig);
            Config::set('email', (array) $emailSetting);
        }
    }
}