<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace ttungbmt\leaflet\widgets;

use ttungbmt\leaflet\LeafLet;
use ttungbmt\leaflet\plugins\extraMarker\ExtraMarkerAsset;
use ttungbmt\leaflet\Yii2LeafletAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Widget Map renders the map using the LeafLet component configurations for rendering on the view.
 * *Important* It is very important to specify the height of the widget, whether with a class name or through an inline
 * style. Failing to configure the height may have unexpected rendering results.
 *
 * @package ttungbmt\leaflet\widgets
 */
class Map extends Widget
{
    /**
     * @var \ttungbmt\leaflet\LeafLet component holding all configuration
     */
    public $leafLet;
    /**
     * @var string the height of the map. Failing to configure the height of the map, will result in
     * unexpected results.
     */
    public $height = '350px';
    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];

    /**
     * Initializes the widget.
     * This method will register the bootstrap asset bundle. If you override this method,
     * make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (empty($this->leafLet) || !($this->leafLet instanceof LeafLet)) {
            throw new InvalidConfigException(
                "'leafLet' attribute cannot be empty and should be of type LeafLet component."
            );
        }
        if (is_numeric($this->height)) {
            $this->height .= 'px';
        }

        Html::addCssStyle($this->options, ['height' => $this->height], false);
    }

    /**
     * Renders the map
     * @return string|void
     */
    public function run()
    {
        echo "\n" . Html::tag('div', '', $this->options);
        $this->registerScript();
    }

    /**
     * Register the script for the map to be rendered according to the configurations on the LeafLet
     * component.
     */
    public function registerScript()
    {
        $view = $this->getView();

        Yii2LeafletAsset::register($view);
        ExtraMarkerAsset::register($view);

        $this->leafLet->getPlugins()->registerAssetBundles($view);

        $id = $this->options['id'];
        $name = $this->leafLet->name;
        $js = $this->leafLet->getJs();

        $clientOptions = $this->leafLet->clientOptions;

        // for map load event to fire, we have to postpone setting view, until events are bound
        // see https://github.com/Leaflet/Leaflet/issues/3560
        $lateInitClientOptions['center'] = Json::encode($clientOptions['center']);
        $lateInitClientOptions['zoom'] = $clientOptions['zoom'];
        if (isset($clientOptions['bounds'])) {
            $lateInitClientOptions['bounds'] = Json::encode($clientOptions['bounds']);
            unset($clientOptions['bounds']);
        }
        unset($clientOptions['center']);
        unset($clientOptions['zoom']);

        $options = empty($clientOptions) ? '{}' : Json::encode($clientOptions, LeafLet::JSON_OPTIONS);
        array_unshift($js, "let $name = this.\$map = L.map('$id', $options);");
        if ($this->leafLet->getTileLayer() !== null) {
            $js[] = $this->leafLet->getTileLayer()->encode();
        }

        $clientEvents = $this->leafLet->clientEvents;

        if (!empty($clientEvents)) {
            foreach ($clientEvents as $event => $handler) {
                $js[] = "$name.on('$event', $handler);";
            }
        }


        if (isset($lateInitClientOptions['bounds'])) {
            $js[] = "$name.fitBounds({$lateInitClientOptions['bounds']});";
        } else {
            $js[] = "$name.setView({$lateInitClientOptions['center']}, {$lateInitClientOptions['zoom']});";
        }


        $pluginOptions = array_merge($this->leafLet->clientOptions, [
            'selectors' => $this->leafLet->selectors
        ]);

        $view->registerJs("function {$name}_init_$id(){\n" . implode("\n", $js) . "};\nyii2Leaflet.initMap('{$name}', {$name}_init_$id, ".Json::encode($pluginOptions, LeafLet::JSON_OPTIONS).")");
    }
}