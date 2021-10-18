<?php

namespace Concrete\Package\MsvS3CompatibleStorage\File\StorageLocation\Adapter;

use League\Flysystem\AdapterInterface;
use \League\Flysystem\AwsS3v3\AwsS3Adapter as AS3Adapter;

class S3CompatibleAdapter implements \League\Flysystem\AdapterInterface
{
    private $adapter = null;

    public function __construct($client, $bucket, $prefix = '', array $options = []) {
        $this->adapter = new AS3Adapter($client, $bucket, $prefix, $options);
    }

    /**
     * Write a new file
     *
     * @param   string       $path
     * @param   string       $contents
     * @param   mixed        $config   Config object or visibility setting
     * @return  false|array  false on failure file meta data on success
     */
    public function write($path, $contents, \League\Flysystem\Config $config = null) {

        $newconfig = new  \League\Flysystem\Config(array());

        $file = $this->adapter->write($path, $contents, $newconfig);

        if($file) {
            $this->adapter->setVisibility($path, AdapterInterface::VISIBILITY_PUBLIC);
        }

        return $file;
    }

    /**
     * Update a file
     *
     * @param   string       $path
     * @param   string       $contents
     * @param   mixed        $config   Config object or visibility setting
     * @return  false|array  false on failure file meta data on success
     */
    public function update($path, $contents, \League\Flysystem\Config $config = null) {
        return $this->adapter->update($path, $contents, $config );
    }

    /**
     * Write a new file using a stream
     *
     * @param   string       $path
     * @param   resource     $resource
     * @param   mixed        $config   Config object or visibility setting
     * @return  false|array  false on failure file meta data on success
     */
    public function writeStream($path, $resource, \League\Flysystem\Config $config = null) {
        $file = $this->adapter->writeStream($path, $resource, $config);

        if($file) {
            $this->adapter->setVisibility($path, AdapterInterface::VISIBILITY_PUBLIC);
        }

        return $file;
    }

    /**
     * Update a file using a stream
     *
     * @param   string       $path
     * @param   resource     $resource
     * @param   mixed        $config   Config object or visibility setting
     * @return  false|array  false on failure file meta data on success
     */
    public function updateStream($path, $resource, \League\Flysystem\Config $config = null) {
        return $this->adapter->updateStream($path, $resource, $config);
    }

    /**
     * Rename a file
     *
     * @param   string  $path
     * @param   string  $newpath
     * @return  boolean
     */
    public function rename($path, $newpath) {
        return $this->adapter->rename($path, $newpath);
    }

    /**
     * Copy a file
     *
     * @param   string  $path
     * @param   string  $newpath
     * @return  boolean
     */
    public function copy($path, $newpath) {
        return $this->adapter->copy($path, $newpath);
    }

    /**
     * Delete a file
     *
     * @param   string  $path
     * @return  boolean
     */
    public function delete($path) {
        return $this->adapter->delete($path);
    }

    /**
     * Delete a directory
     *
     * @param   string  $dirname
     * @return  boolean
     */
    public function deleteDir($dirname) {
        return $this->adapter->deleteDir($dirname);
    }

    /**
     * Create a directory
     *
     * @param   string  $dirname
     * @return  array   directory meta data
     */
    public function createDir($dirname, \League\Flysystem\Config $config) {
        return $this->adapter->createDir($dirname, $config);
    }

    /**
     * Set the visibility for a file
     *
     * @param   string  $path
     * @param   string  $visibility
     */
    public function setVisibility($path, $visibility) {
        return $this->adapter->setVisibility($path, $visibility);
    }

    public function has($path) {
        return $this->adapter->has($path);
    }

    /**
     * Read a file
     *
     * @param   string  $path
     * @return  false|array
     */
    public function read($path) {
        return $this->adapter->read($path);
    }

    /**
     * Read a file as a stream
     *
     * @param   string  $path
     * @return  false|array
     */
    public function readStream($path) {
        return $this->adapter->readStream($path);
    }

    /**
     * List contents of a directory
     *
     * @param   string  $directory
     * @param   bool    $recursive
     * @return  false|array
     */
    public function listContents($directory = '', $recursive = false) {
        return $this->adapter->listContents($directory, $recursive);
    }

    /**
     * Get all the meta data of a file or directory
     *
     * @param   string  $path
     * @return  false|array
     */
    public function getMetadata($path) {
        return $this->adapter->getMetadata($path);
    }

    /**
     * Get all the meta data of a file or directory
     *
     * @param   string  $path
     * @return  false|array
     */
    public function getSize($path) {
        return $this->adapter->getSize($path);
    }

    /**
     * Get the mimetype of a file
     *
     * @param   string  $path
     * @return  false|array
     */
    public function getMimetype($path) {
        return $this->adapter->getMimetype($path);
    }

    /**
     * Get the timestamp of a file
     *
     * @param   string  $path
     * @return  false|array
     */
    public function getTimestamp($path) {
        return $this->adapter->getTimestamp($path);
    }

    /**
     * Get the visibility of a file
     *
     * @param   string  $path
     * @return  false|array
     */
    public function getVisibility($path) {
        return $this->adapter->getVisibility($path);
    }

}
