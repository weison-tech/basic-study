<?php
namespace core\widgets;

/**
 * Base menu.
 * @author xiaomalover <xiaomalover@gmail.com>
 */
class BaseMenu extends \dmstr\widgets\Menu
{
    const EVENT_RUN = 'run';

    public function run()
    {
        //Do sort.
        $this->sortItems();
        //Trigger the run event
        $this->trigger(self::EVENT_RUN);
        parent::run();
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
