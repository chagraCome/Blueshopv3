<?php
class Amhsoft_Html_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    protected $html;
    
    
    
    

    public function __construct($html) {
        $this->html = $html;
    }
    public function setHtml($html) {
      $this->html = $html;
    }

    
    public function Render() {
        return $this->Draw();
    }

    public function Draw() {
        return $this->html;
    }

   

}
