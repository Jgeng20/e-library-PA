<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicationSetting extends Model
{

    protected $table = 'new_application_settings';
    
    protected $fillable = [
        'app_title',
        'app_logo',
        'app_description',
        'app_email',
        'app_phone',
        'facebook_link',
        'twitter_link',
        'instagram_link',
    ];
}
