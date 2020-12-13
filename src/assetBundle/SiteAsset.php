<?php
/**
 * @link https://github.com/engine-core/theme-bootstrap-v3
 * @copyright Copyright (c) 2020 E-Kevin
 * @license BSD 3-Clause License
 */

namespace EngineCore\themes\BootstrapV3\assetBundle;

use yii\web\AssetBundle;

class SiteAsset extends AssetBundle
{
    
    public $sourcePath = '@EngineCore/themes/BootstrapV3/assets';
    
    public $css = [
        'css/site.css',
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\widgets\PjaxAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
    
}