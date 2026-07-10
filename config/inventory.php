<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Inventory Subdomain
    |--------------------------------------------------------------------------
    | The hostname for the inventory subdomain.
    | Set INVENTORY_SUBDOMAIN in .env to override.
    | Production  : inventory.malbaligaleria.com
    | Local dev   : inventory.localhost  (add to hosts file: 127.0.0.1 inventory.localhost)
    */
    'subdomain' => env('INVENTORY_SUBDOMAIN', 'inventory.malbaligaleria.com'),

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist Behavior
    |--------------------------------------------------------------------------
    | When true and the whitelist table for a subdomain is NOT empty,
    | only IPs in the list are allowed. Empty list = open access.
    */
    'ip_whitelist_enabled' => env('INVENTORY_IP_WHITELIST', true),

];
