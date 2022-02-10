<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.gtm_enabled', false);
        $this->migrator->add('general.gtm_id', '');
        $this->migrator->add('general.current_skin', 'default');
    }
}
