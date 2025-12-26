<?php
use Spatie\LaravelSettings\Migrations\SettingsMigration;
return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.siteTitle', config('app.name'));
        $this->migrator->add('site.siteDescription', 'Online Casinon Med Svensk Spellicens');
        $this->migrator->add('site.casinosPerPage', 20);
        $this->migrator->add('site.postsPerPage', 6);
        $this->migrator->add('site.metaImage', null);
        $this->migrator->add('site.siteLogo', null);
        $this->migrator->add('site.siteFavicon', null);
        $this->migrator->add('site.footerText', '<p>Copyright &copy;'. date('Y') . ' ' . config('app.name') . ' / All Rights Reserved</p>');
        $this->migrator->add('site.footerScripts', null);
    }
    public function down(): void
    {
        $this->migrator->delete('site.siteTitle');
        $this->migrator->delete('site.siteDescription');
        $this->migrator->delete('site.casinosPerPage');
        $this->migrator->delete('site.postsPerPage');
        $this->migrator->delete('site.metaImage');
        $this->migrator->delete('site.siteLogo');
        $this->migrator->delete('site.siteFavicon');
        $this->migrator->delete('site.footerText');
        $this->migrator->delete('site.footerScripts');
    }
};
