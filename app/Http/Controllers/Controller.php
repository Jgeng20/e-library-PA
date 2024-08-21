<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\AplicationSetting;
use App\Models\Dashboard;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $application = AplicationSetting::first(); // Ambil data aplikasi pertama
        view()->share('app_title', $application->app_title);
        view()->share('app_logo', $application->app_logo);
        view()->share('app_description', $application->app_description);
        view()->share('app_email', $application->app_email);
        view()->share('app_phone', $application->app_phone);
        view()->share('facebook_link', $application->facebook_link);
        view()->share('instagram_link', $application->instagram_link);
        view()->share('twitter_link', $application->twitter_link);

    }
}
