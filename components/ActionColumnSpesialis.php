<?php



namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class ActionColumnSpesialis extends \yii\grid\ActionColumn
{

    public $headerOptions = [
        'class' => 'action-column',
        'style' => 'width: 55px; text-align: center;'
    ];

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('update', 'pencil');
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $class = 'btn btn-warning btn-sm btn-icon';
                        $url = Url::to(['periksa', 'no_rm' => $model->no_rekam_medik]);
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'class' => $class,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "mdi mdi-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}
