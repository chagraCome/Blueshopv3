<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Resizer.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Image_Resizer {

  protected $image;
  protected $image_type;

  public function getImageType() {
    return $this->image_type;
  }

  public function load($filename) {
    $image_info = getimagesize($filename);
    $this->image_type = $image_info[2];
    if ($this->image_type == IMAGETYPE_JPEG) {
      $this->image = imagecreatefromjpeg($filename);
    } elseif ($this->image_type == IMAGETYPE_GIF) {
      $this->image = imagecreatefromgif($filename);
    } elseif ($this->image_type == IMAGETYPE_PNG) {
      $this->image = imagecreatefrompng($filename);
    }
  }

  public function save($destination, $image_type = IMAGETYPE_JPEG, $compression = 100, $permissions = null) {

    if ($this->image_type == IMAGETYPE_JPEG) {
      @imagejpeg($this->image, $destination, $compression);
    } elseif ($this->image_type == IMAGETYPE_GIF) {
      @imagegif($this->image, $destination);
    } elseif ($this->image_type == IMAGETYPE_PNG) {
      @imagepng($this->image, $destination);
    }
    if ($permissions != null) {
      @chmod($destination, $permissions);
    }
  }

  public function output($image_type = IMAGETYPE_JPEG) {
    if ($image_type == IMAGETYPE_JPEG) {
      imagejpeg($this->image);
    } elseif ($image_type == IMAGETYPE_GIF) {
      imagegif($this->image);
    } elseif ($image_type == IMAGETYPE_PNG) {
      imagepng($this->image);
    }
  }

  public function getWidth() {
    return imagesx($this->image);
  }

  public function getHeight() {
    return imagesy($this->image);
  }

  public function resizePercent($height, $width) {
    if (intval($height) == 0 && intval($width) == 0) {
      $this->resize($this->getWidth(), $this->getHeight());
    }
    if (intval($height) > intval($width)) {
      $this->resizeToHeight($height);
    } else {
      $this->resizeToWidth($width);
    }
  }

  public function resizeTo($height, $width) {
    if (intval($height) == 0 && intval($width) == 0) {
      $this->resize($this->getWidth(), $this->getHeight());
    }
    if (intval($height) > 0 && intval($width) > 0) {
      $this->resize($width, $height);
    }
    if (intval($height) == 0) {
      $this->resizeToWidth($width);
      return;
    }
    if (intval($width) == 0) {
      $this->resizeToHeight($height);
      return;
    }
  }

  public function resizeToHeight($height) {
    $ratio = $height / $this->getHeight();
    $width = $this->getWidth() * $ratio;
    $this->resize($width, $height);
  }

  public function resizeToWidth($width) {
    $ratio = $width / $this->getWidth();
    $height = $this->getheight() * $ratio;
    $this->resize($width, $height);
  }

  public function scale($scale) {
    $width = $this->getWidth() * $scale / 100;
    $height = $this->getheight() * $scale / 100;
    $this->resize($width, $height);
  }

  public function rotate($angle) {
    $this->image = @imagerotate($this->image, $angle, 0);
  }

  public function resize($width, $height) {
    $new_image = @imagecreatetruecolor($width, $height);


    if ($this->image_type == IMAGETYPE_GIF or $this->image_type == IMAGETYPE_PNG) {
      imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127));
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
    }


    @imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
    $this->image = $new_image;
  }

}

?>