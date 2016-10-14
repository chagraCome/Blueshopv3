<?php

/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DebugBar\DataCollector;

/**
 * Collects array data
 */
class EventsCollector extends DataCollector implements Renderable {

    protected $name;
    protected $data;

    /**
     * @param array  $data
     * @param string $name
     */
    public function __construct($name = 'Events') {
        $this->name = $name;
    }

    /**
     * Sets the data
     *
     * @param array $data
     */
    public function addEvent($event, $sender, $args) {
        $this->data[] = array('event' => $event, 'args' => $args);
    }

    public function collect() {
        $data = array();
        foreach ((array) $this->data as $k => $_data) {
            if (!is_string($_data['args'])) {
                $_data['args'] = $this->getDataFormatter()->formatVar($_data['args']);
            }
            $data[$k . '. ' . $_data['event']] = $_data['args'];
        }
        return $data;
    }

    public function getName() {
        return $this->name;
    }

    public function getWidgets() {
        $name = $this->getName();
        return array(
            "$name" => array(
                "icon" => "gear",
                "widget" => "PhpDebugBar.Widgets.VariableListWidget",
                "map" => "$name",
                "default" => "{}"
            )
        );
    }

}
