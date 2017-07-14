<?php
namespace core\modules\home\mobile\widgets;

/**
 * Description of BottomNav
 */
class Entrance extends \yii\widgets\Menu
{
    public $items = [];

    public function run()
    {
        //Do sort.
        $this->sortItems();

        $html = '';

        if (is_array($this->items) && count($this->items)) {
            $items = $this->items;
            $items = array_chunk($items, 2);

            $html .= '<div class="index-entrance tBor">';
            foreach ($items as $group) {
                $html .= '<div class="index-entrance-top bBor">';

                foreach ($group as $item) {
                    $html .= '<a class="index-entrance-item rBor" href="' . $item['url'] . '">
                        <img src="' . $item['icon'] . '">
                    </a>';
                }

                $html .= '</div>';
            }

            $html .= '</div>';
        }

        echo $html;
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
