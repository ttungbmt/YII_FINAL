<?php
namespace ttungbmt\yii\alpine;

use kartik\widgets\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class Alpine extends Widget
{
    /**
     * @var array The data object for the Vue instance.
     */
    public $data;

    /**
     * @var array Computed properties to be mixed into the Vue instance.
     */
    public $computed;

    /**
     * @var array Methods to be mixed into the Vue instance.
     */
    public $methods;

    /**
     * @var array The HTML tag attributes for the widget container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array The options for the Vue.js.
     */
    public $clientOptions = [];

    public $pluginName = 'alpine';

    public function init()
    {
        parent::init();

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        $this->registerAssets();

        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        return $this->initAlpine();
    }

    public function initAlpine(){
        $content = ob_get_clean();

        $html = Html::beginTag('div', [
            'x-data' => new JsExpression("alpine({$this->_hashVar})")
        ]);

        $html .= $content;

        $html .= Html::endTag('div');
        return $html;
    }

    public function registerAssets(){
        $view = $this->getView();
        AlpineAsset::register($view);

        if(!empty($this->data)){
            $this->pluginOptions['data'] = $this->data;
        }

        if(!empty($this->methods)){
            $this->pluginOptions['methods'] = $this->methods;
        }

        $this->registerPluginOptions($this->pluginName);
    }

//    /**
//     * @inheritdoc
//     */
//    public static function begin($config = [])
//    {
//        $object = parent::begin($config);
//
//        echo Html::beginTag('div', $object->options);
//
//        return $object;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function end()
//    {
//        echo Html::endTag('div');
//
//        return parent::end();
//    }

}