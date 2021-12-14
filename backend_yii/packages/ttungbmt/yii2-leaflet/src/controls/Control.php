<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace ttungbmt\leaflet\controls;

use ttungbmt\leaflet\LeafLet;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Control is the base class for all Controls
 *
 * @property string $name
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package ttungbmt\leaflet\controls
 */
abstract class Control extends Component
{
    /**
     * @var string the name of the javascript variable that will hold the reference
     * to the map object.
     */
    public $map;
    /**
     * @var string the initial position of the control (one of the map corners).
     */
    public $position = 'topright';
    /**
     * @var array the options for the underlying LeafLetJs JS component.
     * Please refer to the LeafLetJs api reference for possible
     * [options](http://leafletjs.com/reference.html).
     */
    public $clientOptions = [];

    public $defaultClientOptions = [];
    /**
     * @var string the variable name. If not null, then the js creation script
     * will be returned as a variable. If null, then the js creation script will
     * be returned as a constructor that you can use on other object's configuration options.
     */
    private $_name;

    public function init()
    {
        parent::init();

        $this->mergeDefaultOptions();
    }

    protected function mergeDefaultOptions()
    {
        $this->clientOptions = ArrayHelper::merge($this->defaultClientOptions, $this->clientOptions);
    }

    /**
     * Returns the name of the layer.
     *
     * @param boolean $autoGenerate whether to generate a name if it is not set previously
     *
     * @return string name of the layer.
     */
    public function getName($autoGenerate = true)
    {
        if ($autoGenerate && $this->_name === null) {
            $this->_name = LeafLet::generateName();
        }
        return $this->_name;
    }

    /**
     * Sets the name of the layer.
     *
     * @param string $value name of the layer.
     */
    public function setName($value)
    {
        $this->_name = $value;
    }

    /**
     * Returns the processed js options
     * @return array
     */
    public function getOptions()
    {
        return empty($this->clientOptions) ? '{}' : Json::encode($this->clientOptions, LeafLet::JSON_OPTIONS);
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    abstract public function encode();
}
