# S3 Compatible File Storage Location for Concrete CMS

Supports version 8 and version 9 of Concrete CMS.

Once installed, visit the 'File Storage Location' section of the dashboard to configure a new 'S3 Compatible' storage location.

## S3 Compatibility
By default Amazon's S3 platform is support, but the add-on can also be configured to support other S3 compatible platforms, such as Digital Ocean's 'Spaces'.

To support a platform other than Amazon, enter a URL into the 'Endpoint' when configuring.
If you have your S3 provider configured to serve files through a CDN, enter the URL for this into the 'CDN Endpoint' field.

## Bucket Policy
The Amazon S3 bucket you use will require a bucket policy - a sample one is provided in policynotes.txt


