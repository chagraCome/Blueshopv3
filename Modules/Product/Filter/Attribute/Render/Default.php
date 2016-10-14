<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Modules_Product_Filter_Attribute_Render_Default {

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
            $str = '<aside class="widget widget-categories">
	
	<h3 class="sidebar-title">' . $attributeLabel . '</h3>										
	<ul class="filter_ul">';
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
            $str .= '</ul>	  </aside>';
            return $str;
        }

        if ($type == 'range') {
            $str = '<aside class="widget widget-categories">

					

												<h3 class="sidebar-title">' . $attributeLabel . '</h3>

												

										
                                                                                        <ul class="filter_ul">';
            foreach ($data as $item) {
                switch ($item['status']) {
                    case 1:
                        $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . ' <img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
                        break;
                    case 0:
                        $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . '</a></li>';
                        break;
                    default:
                        $str .='<li><a style="cursor:default;" class="disabled"  href="javascript:void(0);">' . $item['label'] . '</a></li>';
                }
            }
            $str .= '</ul>	</aside>';
            return $str;
        }
        $str = '<aside class="widget widget-categories">

											

												<h3 class="sidebar-title">' . $attributeLabel . '</h3>

												

											
                                                                                        <ul class="filter_ul">';
        foreach ($data as $item) {
            switch ($item['status']) {
                case 1:
                    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $item['label'] . '</a></li>';
                    break;
                case 0:
                    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
                    break;
                default:
                    $str .='<li><a style="cursor:default" class="disabled"  href="javascript:void(0);"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
            }
        }
        $str .= '</ul>	</aside>';
        return $str;
    }

}

?>
