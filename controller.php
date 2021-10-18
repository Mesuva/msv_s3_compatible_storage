<?php
namespace Concrete\Package\MsvS3CompatibleStorage;

use Concrete\Core\Package\Package;
use Concrete\Core\File\StorageLocation\Type\Type;

class Controller extends Package
{
    protected $pkgHandle = 'msv_s3_compatible_storage';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '1.0';

    protected $pkgAutoloaderRegistries = [
        'src/S3CompatibleStorage' => '\Concrete\Package\MsvS3CompatibleStorage',
    ];

    public function on_start()
    {
        require __DIR__ . '/vendor/autoload.php';
    }

    public function getPackageName()
    {
        return t('S3 Compatible Storage');
    }

    public function getPackageDescription()
    {
        return t('S3 Compatible Storage Location for Concrete CMS');
    }

    public function install()
    {
        Type::add('s3_compatible', 'S3 Compatible', parent::install());
    }

}
