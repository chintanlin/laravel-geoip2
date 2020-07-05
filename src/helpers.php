<?php

if (!function_exists('geoip2')) {
    /**
     * Get the Country of the provided IP.
     *
     * @param string $ip
     *
     * @return Chintanlin\GeoIP2\GeoIP2|\GeoIP2\getCountry
     */
    function geoip2($ip = null)
    {
        if (is_null($ip)) {
            return app('geoip2');
        }

        return app('geoip2')->getCountry($ip);
    }
}
