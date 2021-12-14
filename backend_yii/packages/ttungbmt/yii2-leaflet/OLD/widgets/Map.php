<?php
namespace ttungbmt\leaflet\widgets;

use ttungbmt\leaflet\LeafLet;
use ttungbmt\leaflet\LeafletAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class Map extends Widget
{
    /**
     * @var \ttungbmt\leaflet\LeafLet component holding all configuration
     */
    public $leaflet;
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
        if (empty($this->leaflet) || !($this->leaflet instanceof LeafLet)) {
            throw new InvalidConfigException(
                "'leaflet' attribute cannot be empty and should be of type LeafLet component."
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

        LeafLetAsset::register($view);
        $this->leaflet->getPlugins()->registerAssetBundles($view);

        $id = $this->options['id'];
        $name = $this->leaflet->name;
        $app = $this->leaflet->app;
        $js = $this->leaflet->getJs();

        $clientOptions = $this->leaflet->clientOptions;

        // for map load event to fire, we have to postpone setting view, until events are bound
        // see https://github.com/Leaflet/Leaflet/issues/3560
        $lateInitClientOptions['center'] = Json::encode($clientOptions['center']);
        $lateInitClientOptions['zoom'] = $clientOptions['zoom'];
        if (isset($clientOptions['bounds'])) {
            $lateInitClientOptions['bounds'] = $clientOptions['bounds'];
            unset($clientOptions['bounds']);
        }
        unset($clientOptions['center']);
        unset($clientOptions['zoom']);

        $options = empty($clientOptions) ? '{}' : Json::encode($clientOptions, LeafLet::JSON_OPTIONS);
        array_unshift($js, <<< JS
let $name = L.map('$id', $options),
    $app = new MapApp($name);
JS
);
        if ($this->leaflet->getTileLayer() !== null) {
            $js[] = $this->leaflet->getTileLayer()->encode();
        }

        $clientEvents = $this->leaflet->clientEvents;

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

        $view->registerJs("function {$name}_init_$id(){\n" . implode("\n", $js) . "}\n{$name}_init_$id();");
    }

}