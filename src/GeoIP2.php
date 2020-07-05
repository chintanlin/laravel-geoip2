<?php

namespace Chintanlin\GeoIP2;

use GeoIp2\Database\Reader as BaseGeoIp;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\Exception\GeoIp2Exception;


class GeoIP2 extends BaseGeoIp
{
    public function __construct($database)
    {
        return parent::__construct($database);
    }

    public function getCountry($address = null)
    {
        try {
            $record = $this->city($address ?? app('request')->getClientIp());
            return $record->country->name;
        } catch (AddressNotFoundException $e) {
            return 'Unknown';
        } catch (GeoIp2Exception $e) {
            return 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }

    public function getCity($address = null)
    {
        try {
            $record = $this->city($address ?? app('request')->getClientIp());
            return $record->city->name;
        } catch (AddressNotFoundException $e) {
            return 'Unknown';
        } catch (GeoIp2Exception $e) {
            return 'Unknown';
        } catch (\Exception $e) {
            return 'Unknown';
        }
    }
}
