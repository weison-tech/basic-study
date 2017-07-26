<?php
namespace core\components\behaviors;

use Yii;
use yii\base\Behavior;
use core\components\Application;

/**
 * Check device whether PC or mobile, and redirect.
 */
class DeviceSwitcher extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_ACTION => 'check',
        ];
    }

    /**
     * Event handle
     * @param $event
     * @return mixed
     */
    public function check($event)
    {
        $is_mobile_request = $this->is_mobile_request();
        $actionId = $event->action->id;
        $controllerId= $event->action->controller->id;
        $moduleId = $event->action->controller->module->id;
        $param = Yii::$app->request->get();
        if ($is_mobile_request) {
            if ($moduleId != 'mobile') {
                if ($param) {
                    array_unshift($param, "mobile/$controllerId/$actionId");
                } else {
                    $param = ["mobile/$controllerId/$actionId"];
                }
                return $event->action->controller->redirect($param);
            }
        } else {
            if ($moduleId == 'mobile') {
                $baseModule = $event->action->controller->module->module->id;
                if ($param) {
                    array_unshift($param, "/$baseModule/$controllerId/$actionId");
                } else {
                    $param = ["/$baseModule/$controllerId/$actionId"];
                }
                return $event->action->controller->redirect($param);
            }
        }
    }

    /**
     * Check device whether PC or mobile
     * @return bool
     */
    private function is_mobile_request()
    {
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            return true;
        } elseif (strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML") > 0) {
            return true;
        } elseif (preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i',
            $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }
}
