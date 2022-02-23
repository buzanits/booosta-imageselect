<?php
namespace booosta\imageselect;

\booosta\Framework::add_module_trait('webapp', 'imageselect\webapp');

trait webapp
{
  protected function preparse_imageselect()
  {
    $clib = 'vendor/bower-asset/chosen';
    $ilib = 'vendor/bower-asset/image-select/src';

    if($this->moduleinfo['imageselect']):
      $this->add_includes("<script type='text/javascript' src='{$this->base_dir}$clib/chosen.jquery.js'></script>
            <script type='text/javascript' src='{$this->base_dir}$ilib/ImageSelect.jquery.js'></script>
            <link rel='stylesheet' type='text/css' href='{$this->base_dir}$ilib/ImageSelect.css' media='screen' />
            <link rel='stylesheet' type='text/css' href='{$this->base_dir}$clib/chosen.css' media='screen' />");
    endif;
  }
}
