<?php
namespace Concrete\Package\MsvS3CompatibleStorage\File\StorageLocation\Configuration;

use \Aws\S3\S3Client;
use \Concrete\Core\Support\Facade\Config;
use \Concrete\Core\Error\ErrorList\ErrorList;
use \Concrete\Core\File\StorageLocation\Configuration\Configuration;
use \Concrete\Core\File\StorageLocation\Configuration\ConfigurationInterface;
use \Concrete\Package\MsvS3CompatibleStorage\File\StorageLocation\Adapter\S3CompatibleAdapter;


class S3CompatibleConfiguration extends Configuration implements ConfigurationInterface
{
    public function hasPublicURL()
    {
        return true;
    }

    public function hasRelativePath()
    {
        return false;
    }

    public function loadFromRequest(\Concrete\Core\Http\Request $req)
    {
        $bucket = $req->post('bucket');
        $key = $req->post('key');
        $secret = $req->post('secret');
        $region = $req->post('region');
        $endpoint = $req->post('endpoint');
        $cdn = $req->post('cdn');

        Config::save('amazon_s3_storage.bucket', $bucket);
        Config::save('amazon_s3_storage.key', $key);
        Config::save('amazon_s3_storage.secret', $secret);
        Config::save('amazon_s3_storage.region', $region);
        Config::save('amazon_s3_storage.endpoint', $endpoint);
        Config::save('amazon_s3_storage.cdn', $cdn);

        return  new ErrorList();
    }

    public function validateRequest(\Concrete\Core\Http\Request $req)
    {
        return new ErrorList();
    }

    public function getAdapter()
    {
        return new S3CompatibleAdapter($this->getClient(), Config::get('amazon_s3_storage.bucket'));
    }

    protected function getClient()
    {
        $config =[
            'credentials' => [
                'key'    => Config::get('amazon_s3_storage.key'),
                'secret' => Config::get('amazon_s3_storage.secret'),
            ],
            'region' => Config::get('amazon_s3_storage.region'),
            'version' => 'latest',
        ];

        $endpoint = Config::get('amazon_s3_storage.endpoint');

        if ($endpoint) {
            $config['endpoint'] = $endpoint;
        }

        return new S3Client($config);
    }

    public function getPublicURLToFile($file)
    {
        $cdn = Config::get('amazon_s3_storage.cdn');
        if ($cdn) {
            return  $cdn . $file;
        }

        return str_replace('.com//', '.com/', $this->getClient()->getObjectUrl(Config::get('amazon_s3_storage.bucket'), $file));
    }

    public function getRelativePathToFile($file)
    {
        return null;
    }
}
