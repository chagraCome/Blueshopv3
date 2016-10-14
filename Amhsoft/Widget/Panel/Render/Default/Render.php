<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Render.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Widget_Panel_Render_Default_Render extends Amhsoft_Widget_Panel_Render_Abstract{

    public function Render() {
        $html = '';
        
        $widget = $this->getWiget();
        
        $components = $widget->getComponents();
        $components->rewind();
        
        while ($components->valid()) {
            $dock_style_attribute = $widget->getDockStyle() ? ' class="' . $widget->getDockStyle() . '"' : '';
            if ($components->current() instanceof Amhsoft_Widget_Container) {
                $html .= $components->current()->Render();
                $components->next();
                continue;
            }
            if ($components->current() instanceof Amhsoft_CheckBox_Control || $components->current() instanceof Amhsoft_RadioBox_Control) {
                
                $html .= '<div' . $dock_style_attribute . '>' . PHP_EOL;
                //$html .= $components->current()->Render() . ' &nbsp;<label class="panellabel" for="' . $components->current()->getName() . '">' . $components->current()->Label . ':</label></div>' . PHP_EOL;
                $html .= '<label for="' . ($components->current()->getId() ? $components->current()->getId() : $components->current()->getName()) . '">' . $components->current()->Render() . ' &nbsp;' . $components->current()->Label .$components->current()->ToolTip .'</label></div>' . PHP_EOL;
                $components->next();
                continue;
            }
            if ($components->current() instanceof Amhsoft_Button_Submit_Control || $components->current() instanceof Amhsoft_Link_Control) {
                $html .= '<div' . $dock_style_attribute . '>' . PHP_EOL;
                $html .= $components->current()->Render() . '</div>' . PHP_EOL;
                $components->next();
                continue;
            }
            if ($components->current() instanceof Amhsoft_DataGridView_Component) {
                $html .= '<div>' . PHP_EOL;
                $html .= $components->current()->Render() . '</div>' . PHP_EOL;
                $components->next();
                continue;
            }

            if ($components->current() instanceof Amhsoft_Label_Control) {
                $html .= '<div' . $dock_style_attribute . '>' . PHP_EOL;
                //$html .= '<label class="panellabel" for="' . $components->current()->getName() . '">' . $components->current()->getLabel() . ':</label>&nbsp;' . PHP_EOL;
                $html .= $components->current()->Render() . '&nbsp;' . PHP_EOL;
                $html .= '</div>' . PHP_EOL;
                $components->next();
                continue;
            }

            if ($components->current() instanceof Amhsoft_ImageControl_Control) {
                $html .= '<div' . $dock_style_attribute . '>' . PHP_EOL;
                $html .= $components->current()->Render() . PHP_EOL;
                $html .= '</div>' . PHP_EOL;
                $components->next();
                continue;
            }

            if ($components->current() instanceof Amhsoft_Paragraph_Control) {
                $html .= $components->current()->Render() . PHP_EOL;
                $components->next();
                continue;
            }

            if ($components->current() instanceof Amhsoft_Heading_Control) {
                $html .= $components->current()->Render() . PHP_EOL;
                $components->next();
                continue;
            }
            
            if ($components->current() instanceof Amhsoft_Html_Control) {
                $html .= $components->current()->Render() . PHP_EOL;
                $components->next();
                continue;
            }

            $html .= '<div' . $dock_style_attribute . '>' . PHP_EOL;

            $html .= $components->current()->getLabel() ? '<label class="panellabel" for="' . $components->current()->getTagName() . '">' . $components->current()->getLabel() . ':</label>' . PHP_EOL : null;

            //$html .= $components->current()->getLabel() ? '<label class="panellabel" for="' . $components->current()->getTagName() . '">' . $components->current()->getLabel() . ':</label>&nbsp;' . PHP_EOL : null;

            $html .= $components->current()->Render() . PHP_EOL;
            $html .= '</div>' . PHP_EOL;
            $components->next();
        }

        $panel_style = $widget->getStyle() ? ' style="' . $widget->getStyle(). '"' : '';
        
        $id_string = $widget->getId() ? ' id="'.$widget->getId().'"' : null;
        if (trim($widget->getLabel()) == null) {
            return '<div' . $panel_style .$id_string. '>' . $html . '</div>';
        } else {
            return '<fieldset' . $panel_style . $id_string.'  ><legend>' . $widget->getLabel() . '</legend>' . PHP_EOL . $html . PHP_EOL . '</fieldset>';
        }
    }

}
