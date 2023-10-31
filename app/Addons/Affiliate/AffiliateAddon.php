<?php

namespace App\Addons\Affiliate;

use App\LaravelAddons\Addon;

class AffiliateAddon extends Addon
{
    public $name = 'Affiliate';

    public function boot()
    {
        $this->enableViews();
    }
}
