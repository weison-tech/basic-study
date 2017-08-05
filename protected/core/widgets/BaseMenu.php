<?php

namespace core\widgets;

use Yii;

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

        $hasPermission = $this->hasPermission($item);

        if ($hasPermission) {
            $this->items[] = $item;
        }
    }

    private function hasPermission($item)
    {
        //Check whether has permission, if not, hidden it in menu.
        $hasPermission = false;

        $url = isset($item['url']) ? $item['url'] : '#'; //If the menu is one level menu.
        if ($url != '#' && $url != '') {
            if (Yii::$app->admin->can($url)) {
                $hasPermission = true;
            } else {
                //Check if has wildcard (eg. /admin/*)
                $temp = explode("/", $url);
                $temp = array_filter($temp);
                foreach ($temp as $k => $v) {
                    $match = '';
                    $i = $k;
                    do {
                        $match =  '/' . $temp[$i] . $match;
                        $i--;
                    } while($i > 0);

                    if (Yii::$app->admin->can($match . '/*')) {
                        $hasPermission = true;
                        break;
                    }
                }

                //Check whether the action is not need permission check.
                if ($hasPermission === false) {
                    $url = ltrim($url, "/");
                    foreach (Yii::$app->params['notCheckPermissionAction'] as $route) {
                        if (substr($route, -1) === '*') {
                            $route = rtrim($route, '*');
                            if ($route === '' || strpos($url, $route) === 0) {
                                $hasPermission = true;
                                break;
                            }
                        } else {
                            if ($url === $route) {
                                $hasPermission = true;
                                break;
                            }
                        }
                    }
                }
            }
        } else { //TODO More than one level
            $hasPermission = true;
        }

        return $hasPermission;
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
