<?php
/**
 * @link https://github.com/engine-core/theme-bootstrap-v3
 * @copyright Copyright (c) 2020 E-Kevin
 * @license BSD 3-Clause License
 */

/* @var $this \yii\web\View */
/* @var $content string */

use EngineCore\Ec;
use EngineCore\extension\repository\info\ExtensionInfo;
use EngineCore\themes\BootstrapV3\assetBundle\SiteAsset;
use EngineCore\themes\BootstrapV3\widgets\Nav;
use yii\helpers\Html;
use yii\bootstrap\NavBar;

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    $this->registerMetaTag([
        'charset' => Yii::$app->charset,
    ]);
    $this->registerMetaTag([
        'http-equiv' => 'X-UA-Compatible',
        'content'    => 'IE=edge',
    ]);
    $this->registerMetaTag([
        'name'    => 'viewport',
        'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no',
    ]);
    $this->registerMetaTag([
        'name'    => 'description',
        'content' => Html::encode(Ec::$service->getSystem()->getConfig()->get('WEB_SITE_DESCRIPTION')),
    ], 'description');
    $this->registerMetaTag([
        'name'    => 'keywords',
        'content' => Html::encode(Ec::$service->getSystem()->getConfig()->get('WEB_SITE_KEYWORD')),
    ], 'keywords');
    echo Html::csrfMetaTags();
    echo Html::tag('title', Html::encode($this->title));
    ?>
    <?php $this->head() ?>
</head>
<body>

<div class="wrap">
    <?php $this->beginBody() ?>
    
    <?php
    NavBar::begin([
        'brandLabel'            => Yii::$app->name,
        'brandUrl'              => Yii::$app->homeUrl,
        'options'               => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid',
        ],
    ]);
    // 导航菜单
    $menuItems = Ec::$service->getMenu()->getPage()->generateNavigation('backend', [
        ['modularity' => ['not in', Ec::$service->getExtension()->getModularityRepository()->getUninstalledModuleIdByApp()]],
        'show_on_menu' => 1,
        'status'       => 1,
    ]);
    echo Nav::widget([
        'options'            => ['class' => 'navbar-nav'],
        'titleField'         => 'alias_name',
        'dropdownTitleField' => 'alias_name',
        'items'              => $menuItems,
    ]);
    // 右侧菜单
    $rightMenuItems = [];
    if (Ec::$service->getExtension()->getRepository()->existsByCategory(ExtensionInfo::CATEGORY_PASSPORT)) {
        if (Yii::$app->user->isGuest) {
            $rightMenuItems[] = ['label' => 'Signup', 'url' => ['/passport/common/signup']];
            $rightMenuItems[] = ['label' => 'Login', 'url' => ['/passport/common/login']];
        } else {
            $rightMenuItems[] = '<li>'
                . Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['/passport/common/logout'], [
                    'class'       => 'btn btn-link logout',
                    'data-method' => 'post',
                ])
                . '</li>';
        }
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items'   => $rightMenuItems,
    ]);
    NavBar::end();
    ?>
    
    <?= $content ?>
    
    <?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
