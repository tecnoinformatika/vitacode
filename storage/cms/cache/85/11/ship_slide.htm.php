<?php 
class Cms5bbebc0fdc096214531235_e6db4e30dca10e53a97b6f0719a1b148Class extends Cms\Classes\PartialCode
{
public function onStart()
{
    $this['url'] = base_path('storage');
    $ship_slide = DB::table('ideas_theme_config_image_detail')->join('ideas_theme_config', 'ideas_theme_config.id', '=', 'ideas_theme_config_image_detail.theme_config_id')->where('ideas_theme_config.slug', '=', 'ship_slide')->select('ideas_theme_config_image_detail.title as title', 'ideas_theme_config_image_detail.description as description', 'ideas_theme_config_image_detail.url as image')->get();

  $this['ship_slide'] = $ship_slide;
    
}
}
