<?php
namespace core\modules\admin\widgets;

use Yii;

/**
 * Description of AdminMenu
 */
class AdminMenu extends \core\widgets\BaseMenu
{
    public function init()
    {
        $this->options = ['class' => 'sidebar-menu'];
        $this->addItem(
            [
                'label' => Yii::t('AdminModule.widgets_AdminMenu', 'System Setting'),
                'icon' => 'cog',
                'url' => '#',
                'sortOrder' => 1,
                'items' => [
                    ['label' => Yii::t('AdminModule.widgets_AdminMenu', 'File Setting'), 'icon' => 'circle-o', 'url' => ['/file/setting'],],
                ],
            ]
        );

        return parent::init();
    }
}
