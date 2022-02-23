<?php
namespace booosta\imageselect;

\booosta\Framework::add_module_trait('webapp', 'imageselect\webapp');

trait webapp
{
  protected function preparse_imageselect()
  {
    $lib = 'vendor/harvesthq/chosen';

    if($this->moduleinfo['imageselect']):
      $this->add_includes("<script type='text/javascript' src='{$this->base_dir}$lib/chosen.jquery.js'></script>
            <script type='text/javascript' src='{$this->base_dir}$lib/ImageSelect.jquery.js'></script>
            <link rel='stylesheet' type='text/css' href='{$this->base_dir}$lib/ImageSelect.css' media='screen' />
            <link rel='stylesheet' type='text/css' href='{$this->base_dir}$lib/chosen.css' media='screen' />");
    endif;
  }
}
