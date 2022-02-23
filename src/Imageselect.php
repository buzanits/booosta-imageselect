<?php
namespace booosta\imageselect;

use \booosta\Framework as b;
b::init_module('imageselect');

class Imageselect extends \booosta\ui\UI
{
  use moduletrait_imageselect;

  protected $select;
  protected $onchange;
  protected $width = '100%';
  protected $placeholder;
  protected $extra;
  protected $image;

  public function __construct($name = null, $options = null, $default = null, $caption = null, $size = null, $multiple = null)
  {
    parent::__construct();
    $this->select = $this->makeInstance("\\booosta\\formelements\\Select", "{$name}[]", $options, $default, null, $size, $multiple);
    $this->select->set_id("imageselect_$name");
    $this->id = "imageselect_$name";
    $this->placeholder = $caption;
    $this->extra = '';
    $this->image = [];
  }

  public function after_instanciation()
  {
    parent::after_instanciation();

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\Webapp")):
      $this->topobj->moduleinfo['imageselect'] = true;
      if($this->topobj->moduleinfo['jquery']['use'] == '') $this->topobj->moduleinfo['jquery']['use'] = true;
    endif;
  }

  public function onchange($code) { $this->onchange = $code; }
  public function set_type($type) { $this->type = $type; }
  public function set_width($width) { $this->width = $width; }
  public function set_placeholder($placeholder) { $this->placeholder = $placeholder; }
  public function add_extra($code) { $this->extra .= $code; }

  public function set_images($images) { $this->image = $images; }
  public function set_image($key, $image) { $this->image[$key] = $image; }

  public function get_htmlonly() { 
    $this->select->set_extra_attr("class='class_$this->id' multiple='multiple'");
    if($this->placeholder) $this->select->set_extra_attr("placeholder='$this->placeholder'");

    $attrs = [];
    foreach($this->image as $key=>$image) $attrs[$key] = "data-img-src='$image'";
    $this->select->set_option_attrs($attrs);
    return $this->select->get_html(); 
  }

  public function get_js()
  {
    $code = '';
    if($this->onchange) $extra = "onChange: function(value) { $this->onchange; }, ";
    $extra .= $this->extra;

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\webapp")):
      $this->topobj->add_jquery_ready("\$('.class_$this->id').chosen({ width: '$this->width' }); ");
      return '';
    else:
      return "\$(document).ready(function(){ \$('.class_$this->id').chosen({ width: '$this->width' }); ";
    endif;
  }

  public function __call($name, $args)
  {
    return call_user_func_array([$this->select, $name], $args);
  }
}
