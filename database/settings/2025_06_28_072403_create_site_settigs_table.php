<?php
use Spatie\LaravelSettings\Migrations\SettingsMigration;
return new class extends SettingsMigration
{
    var string $footerText = '<h2>SlotDudes – Online Casino Listings, Reviews &amp; Gambling News</h2><p>SlotDudes is an independent website focused on&nbsp;<strong>listing, reviewing, and comparing online casinos</strong>, along with covering online slots and the latest news from the gambling industry. Run by two Swedish enthusiasts with a long-standing interest in online casinos and slot games, SlotDudes aims to provide clear, honest, and up-to-date information for&nbsp;<strong>adult users aged 18 and over</strong>.</p><p>On <a target="_blank" rel="noopener noreferrer nofollow" href="http://SlotDudes.com">SlotDudes.com</a>, visitors can explore detailed&nbsp;<strong>online casino reviews and rankings</strong>. We analyze licensed casino platforms based on factors such as game selection, bonuses, usability, payment methods, customer support, and overall player experience. Our listings are designed to help users compare online casinos and understand what separates one platform from another, with a particular focus on casinos relevant to the Swedish and European markets.</p><p>In addition to casino listings, SlotDudes also publishes&nbsp;<strong>online slot reviews and gameplay insights</strong>. These reviews cover themes, features, volatility, RTP (Return to Player), and bonus mechanics, giving readers a clearer picture of how different slot games function. Slot content is meant to complement our casino reviews and provide additional context for players interested in game selection.</p><p>Staying informed is important in a fast-changing industry, which is why SlotDudes also covers&nbsp;<strong>online casino and gambling news</strong>. This includes updates on new casino launches, slot releases, software providers, regulatory changes, and broader industry trends. Our news content helps readers stay aware of developments that may affect their choices as online casino players.</p><p>SlotDudes is also active on&nbsp;<strong>Instagram</strong>, where we share short slot gameplay clips, highlights from new releases, and behind-the-scenes content. Our social media presence is designed to be entertaining and informative, offering a visual look at online casino games while maintaining a responsible and transparent approach.</p><h3>Affiliate Disclosure &amp; Transparency</h3><p>To keep SlotDudes running and continue producing free content, the website contains&nbsp;<strong>affiliate links</strong>&nbsp;to selected online casinos and related services. If a visitor chooses to register through one of these links, SlotDudes may receive an&nbsp;<strong>affiliate commission at no extra cost to the user</strong>. These commissions help fund website operations, content production, and ongoing improvements.</p><p>Affiliate relationships do&nbsp;<strong>not</strong>&nbsp;affect our reviews or rankings. We strive to remain independent and transparent, and we only feature casinos that are properly licensed and relevant to our audience.</p><p>Responsible gambling is a core value at SlotDudes. Online casinos and slots are intended for entertainment only, and players should always gamble responsibly, set limits, and never risk more than they can afford to lose.</p><p>Whether you are looking to compare online casinos, read honest reviews, or stay updated on gambling-related news, SlotDudes aims to be a reliable and transparent resource for adult users.</p>';

    public function up(): void
    {
        $this->migrator->add('site.siteTitle', config('app.name'));
        $this->migrator->add('site.siteDescription', 'Online Casinon Med Svensk Spellicens');
        $this->migrator->add('site.casinosPerPage', 20);
        $this->migrator->add('site.postsPerPage', 6);
        $this->migrator->add('site.metaImage', null);
        $this->migrator->add('site.siteLogo', null);
        $this->migrator->add('site.siteFavicon', null);
        $this->migrator->add('site.footerText', $this->footerText);
        $this->migrator->add('site.copyrightText', '<p>Copyright &copy;'. date('Y') . ' ' . config('app.name') . ' / All Rights Reserved</p>');
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
        $this->migrator->delete('site.copyrightText');
        $this->migrator->delete('site.footerScripts');
    }
};
