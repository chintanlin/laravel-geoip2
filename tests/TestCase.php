<?php

class TestCase extends Orchestra\Testbench\TestCase
{
    //
    protected function getPackageProviders($app)
    {
        return ["Chintanlin\\GeoIP2\\GeoIP2ServiceProvider"];
    }
    protected function getPackageAliases($app)
    {
        return [
            "GeoIP2" => "Chintanlin\\GeoIP2\\Facades\\GeoIP2"
        ];
    }

    /**
     * @group download
     */
    public function testDatabaseUpdate()
    {
        $this->artisan('geoip2:update')
            ->assertExitCode(0);

        $filePath = storage_path('app/GeoLite2-City.mmdb');;
        $this->assertFileExists($filePath);
    }

    /**
     * @group geoip2
     */
    public function testFacades()
    {
        $Country = GeoIP2::getCountry('8.8.8.8');
        $this->assertSame($Country, 'United States');
    }

    /**
     * @group geoip2
     */
    public function testProviders()
    {
        $Country = app('geoip2')->getCountry('8.8.8.8');
        $this->assertSame($Country, 'United States');
    }

    /**
     * @group geoip2
     */
    public function testHelpers()
    {
        $Country = geoip2('8.8.8.8');
        $this->assertSame($Country, 'United States');
    }

    /**
     * @group geoip2
     */
    public function testMaxmind()
    {
        $record = GeoIP2::city('8.8.8.8');
        $this->assertSame($record->country->name, 'United States');
    }
}
