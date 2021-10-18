<?php $form = \Core::make('helper/form'); ?>

<div class="form-group">
    <?php echo $form->label('bucket',t("Bucket")); ?>
    <?php echo $form->text('bucket',\Config::get('amazon_s3_storage.bucket'), array('placeholder'=>t('Bucket Name'))); ?>
</div>

<div class="form-group">
    <?php echo $form->label('key',t("Key")); ?>
    <?php echo $form->text('key',\Config::get('amazon_s3_storage.key'), array('placeholder'=>t('Key'))); ?>
</div>

<div class="form-group">
    <?php echo $form->label('secret',t("Secret")); ?>
    <?php echo $form->text('secret',\Config::get('amazon_s3_storage.secret'), array('placeholder'=>t('Secret'))); ?>
</div>

<div class="form-group">
    <?php echo $form->label('region',t("Region")); ?>
    <?php echo $form->text('region',\Config::get('amazon_s3_storage.region'), array('placeholder'=>t('Region'))); ?>
</div>

<div class="form-group">
    <?php echo $form->label('endpoint',t("Endpoint (optional)")); ?>
    <?php echo $form->url('endpoint',\Config::get('amazon_s3_storage.endpoint'), array('placeholder'=>t('e.g. https://your-region.digitaloceanspaces.com'))); ?>
    <p class="help-block"><?= t('Configure this value for other S3 compatible providers');?></p>
</div>


<div class="form-group">
    <?php echo $form->label('cdn',t("CDN Endpoint (optional)")); ?>
    <?php echo $form->url('cdn',\Config::get('amazon_s3_storage.cdn'), array('placeholder'=>t('e.g. https://your-region.cdn.digitaloceanspaces.com'))); ?>
</div>

