<?php
namespace core\modules\home\mobile\widgets;

use Yii;
/**
 * Description of BottomNav
 */
class Shortcut extends \yii\widgets\Menu
{
    public $items = [];

    public function run()
    {
        //Do sort.
        $this->sortItems();

        $theme = Yii::$app->view->theme->name;

        return $this->render("$theme/shortcut", array(
            'items' => $this->items
        ));
    }

    /**
     * @param array $item the menu item
     */
    public function addItem($item)
    {
        if (!isset($item['label'])) {
            $item['label'] = 'Unnameds';
        }

        if (!isset($item['url'])) {
            $item['url'] = '#';
        }

        if (!isset($item['icon'])) {
            $item['icon'] = '';
        }

        if (!isset($item['sortOrder'])) {
            $item['sortOrder'] = 1000;
        }

        if (isset($item['isVisible']) && !$item['isVisible']) {
            return;
        }

        $this->items[] = $item;
    }

    /**
     * Sorts the item attribute by sortOrder
     */
    private function sortItems()
    {
        usort($this->items, function ($a, $b) {
            if ($a['sortOrder'] == $b['sortOrder']) {
                return 0;
            } else {
                if ($a['sortOrder'] < $b['sortOrder']) {
                    return -1;
                } else {
                    return 1;
                }
            }
        });
    }
}
