<?php

use kartik\tree\TreeView;
use common\models\SiteMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SiteMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-menu-index">
    <?php echo TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => SiteMenu::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Категории'],
        'fontAwesome' => true, // optional
        'isAdmin' => true, // optional (toggle to enable admin mode)
        'displayValue' => 1, // initial display value
        'softDelete' => false, // defaults to true
        'cacheSettings' => [
            'enableCache' => false // defaults to true
        ],
        'nodeAddlViews' => [
            \kartik\tree\Module::VIEW_PART_2 => '@backend/views/site-menu/_form',
        ]
    ]);
    ?>
</div>