<?php

namespace Chintanlin\GeoIP2\Console;

use Illuminate\Console\Command;
use PharData;

class Update extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'geoip2:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update GeoIp database files to the latest version';

    /**
     * Execute the console command for Laravel 5.5 and newer.
     *
     * @return void
     */
    public function handle()
    {
        $this->fire();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        
        $this->comment('Updating...');

        // Settings
        $url = 'https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=xxxx&suffix=tar.gz';
        $mmdb_path = storage_path('app/GeoLite2-City.mmdb');

        // Get header response
        $headers = get_headers($url);
        if (substr($headers[0], 9, 3) != '200') {
            $this->error('Unable to download database. (' . substr($headers[0], 13) . ')');
        }

        // Download zipped database to a system temp file
        $tmpFolder = tempnam(sys_get_temp_dir(), 'maxmind');
        if (file_exists($tmpFolder)) {
            unlink($tmpFolder);
        }
        mkdir($tmpFolder);

        file_put_contents($tmpFolder . '/GeoLite2-City.mmdb.tar.gz', fopen($url, 'r'));
        // Unzip and save database

        $p = new PharData($tmpFolder . '/GeoLite2-City.mmdb.tar.gz');
        $p->decompress(); // 解壓縮成 GeoLite2-City.mmdb.tar

        // unarchive from the tar
        $phar = new PharData($tmpFolder . '/GeoLite2-City.mmdb.tar');
        $dir = $phar->current()->getPathname();
        $dir = basename($dir);

        $phar->extractTo($tmpFolder, $dir . '/GeoLite2-City.mmdb', true); // 解開檔案到 path
        rename($tmpFolder . '/' . $dir . '/GeoLite2-City.mmdb', $mmdb_path);
        // Remove temp file
        @unlink($tmpFolder . '/GeoLite2-City.mmdb.tar.gz');
        @unlink($tmpFolder . '/GeoLite2-City.mmdb.tar');
        @rmdir($tmpFolder . '/' . $dir);
        @rmdir($tmpFolder);
        $this->info("Database file ({$mmdb_path}) updated.");
    }
}
