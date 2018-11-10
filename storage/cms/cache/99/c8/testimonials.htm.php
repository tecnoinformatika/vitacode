<?php 
class Cms5bbebc0fda5b1841700131_98a2b64b51b39dd30f05e2667769ff81Class extends Cms\Classes\PartialCode
{
public function onStart()
{
    $this['url'] = base_path('storage');
    $testimonials = DB::table('ideas_theme_config_image_detail')->join('ideas_theme_config', 'ideas_theme_config.id', '=', 'ideas_theme_config_image_detail.theme_config_id')->where('ideas_theme_config.slug', '=', 'testimonials')->select('ideas_theme_config_image_detail.title as title', 'ideas_theme_config_image_detail.description as description', 'ideas_theme_config_image_detail.url as image')->get();

  $this['testimonials'] = $testimonials;
    
}
}
