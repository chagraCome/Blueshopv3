<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Modules_Product_Filter_Attribute_Render_Dav_Default {

    /**
     * Render
     * @param type $attributeName
     * @param type $attributeLabel
     * @param type $data
     * @param type $type
     * @return null|string
     */
    public static function Render($attributeName, $attributeLabel, $data, $type = null) {
        if (empty($data)) {
            return null;
        }

        //render color input
        if ($type == 'color') {
            $str = '<div class="expandable-panel" id="cp-1"><div class="expandable-panel-heading"><h2>' . $attributeLabel . '<span class="icon-close-open"></span></h2></div>';
            $str .= '<div class="expandable-panel-content">';
            foreach ($data as $item) {
                $colorLabel = new Amhsoft_ColorLabel_Control('Color');
                $colorLabel->Value = $item['label'];
                switch ($item['status']) {
                    case 1:
                        $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $colorLabel->Render() . '</a></li>';
                        break;
                    case 0:
                        $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $colorLabel->Render() . '</a></li>';
                        break;
                    default:
                        $str = null;
                }
            }
            $str .= '</div></div>';
            return $str;
        }

        if ($type == 'range') {
            $str = '<div class="expandable-panel" id="cp-1"><div class="expandable-panel-heading"><h2>' . $attributeLabel . '<span class="icon-close-open"></span></h2></div>';
            $str .= '<div class="expandable-panel-content">';
            foreach ($data as $item) {
                switch ($item['status']) {
                    case 1:
                        $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . ' <img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
                        break;
                    case 0:
                        $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . '</a></li>';
                        break;
                    default:
                        $str .='<li><a style="cursor:default;" class="disabled"  href="#">' . $item['label'] . '</a></li>';
                }
            }
            $str .= '</div></div>';
            return $str;
        }
        $str = '<div class="expandable-panel" id="cp-1"><div class="expandable-panel-heading"><h2>' . $attributeLabel . '<span class="icon-close-open"></span></h2></div>';
        $str .= '<div class="expandable-panel-content">';
        foreach ($data as $item) {
            switch ($item['status']) {
                case 1:
                    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $item['label'] . '</a></li>';
                    break;
                case 0:
                    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
                    break;
                default:
                    $str .='<li><a style="cursor:default" class="disabled"  href="#"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
            }
        }
        $str .= '</div></div>';
        return $str;
    }

}

?>
