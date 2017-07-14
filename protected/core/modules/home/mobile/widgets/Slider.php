<?php
namespace core\modules\home\mobile\widgets;

use Yii;

/**
 * Description of Slider
 * This widget need mui's css and js.
 */
class Slider extends \yii\widgets\Menu
{
    /**
     * The data used by this widget to display slide.
     * The format should like bellow:
     * [
     *       [
     *          'title' => 'banner1',
     *          'image' => '/img/picture1.jpg',
     *          'sortOrder' => 1,
     *          'url' => '#',
     *       ],
     *       [
     *          'title' => 'banner1',
     *          'image' => '/img/picture2.jpg',
     *          'sortOrder' => 2,
     *          'url' => '#',
     *       ],
     * ];
     * @var array data item
     */
    public $items = [];

    /**
     * The width of the slide picture, default to be 100%
     * @var string
     */
    public $width = '100%';

    /**
     * The height of the slide picture, default to be 250px
     * @var string
     */
    public $height = '250px';

    /**
     * The slide auto play indicate.
     * If this value is 0, never auto play,
     * If others, this value will be used as the auto play interval(Unit is milliseconds).
     * @var integer
     */
    public $auto = 0;

    /**
     * The slide loop play indicate.
     * @var bool
     */
    public $loop = false;

    public function run()
    {
        //Do sort.
        $this->sortItems();

        $theme = Yii::$app->view->theme->name;

        return $this->render("$theme/slider", array(
            'items' => $this->items,
            'loop' => $this->loop,
            'auto' => $this->auto,
            'width' => $this->width,
            'height' => $this->height,
        ));
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
