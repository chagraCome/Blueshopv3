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
class Amhsoft_Widget_Form_Render_Kendoui_Render extends Amhsoft_Widget_Form_Render_Abstract {

    public function Render() {
        
        $event = 'before.render.' . get_class($this->getWidget());
        Amhsoft_Event_Handler::trigger($event, $this->getWidget(), null);

        $html = '';
        if ($this->getWidget()->getMethod()) {
            $multipart = $this->getWidget()->getMultipart() ? 'enctype="multipart/form-data"' : null;
            $html = '<form id="' . $this->getWidget()->getName() . '" name="' . $this->getWidget()->getName() . '" method="' . $this->getWidget()->getMethod() . '" action="' . $this->getWidget()->getAction() . '" class="' . $this->getWidget()->getClass() . '" ' . $multipart . '>';
            $html .= '<ul data-role="listview" data-style="inset">';
        }

        $components = $this->getWidget()->getComponents();
       
        $components->rewind();
       
        
        foreach ($components as $component) {

            if ($component instanceof Amhsoft_Widget_Panel || $component instanceof Amhsoft_Abstract_Layout || $component instanceof Amhsoft_Widget_DataGridView) {
                $html .= $component->Render();
            } elseif ($component instanceof Amhsoft_CheckBox_Control || $component instanceof Amhsoft_RadioBox_Control) {
                $html .= '<li>'.$component->Render() . ' &nbsp;' . $component->getLabel() . '</li>' . PHP_EOL;
            } elseif ($component instanceof Amhsoft_Button_Submit_Control) {
                $html .= '<li>'.$component->Render() . '</li>' . PHP_EOL;
            } elseif ($component instanceof Amhsoft_Link_Control || $component instanceof Amhsoft_Html_Control) {
                $html .= '<li>'.$component->Render(). '</li>' . PHP_EOL;
            } else {
                $html .= '<li>' .$component->Render(). $component->getLabel() . '</li>';
            }
            
        }
        if ($this->getWidget()->getMethod()) {
            $html .= '</ul></form>';
        }

        if ($this->getWidget()->isJavascriptValidation()) {
            $html .= '<script type="text/javascript">
                    <!--
                    $(document).ready(function(){
                    $("#' . $this->getWidget()->getName() . '").validate();
                    });
                    -->
                    </script>';
        }
        $event = 'after.render.' . get_class($this->getWidget());
        Amhsoft_Event_Handler::trigger($event, $this->getWidget(), $html);
        return $html;
    }

}

?>
