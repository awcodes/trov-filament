<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public bool $gtm_enabled;
    public ?string $gtm_id;
    public ?string $current_skin;

    public static function group(): string
    {
        return 'general';
    }
}
