<?php
/*
Plugin Name: BeLocal Widget
Plugin URI: http://widget.belocal.com/
Description: BeLocal Wordpress plugin
Author: John Burch
Version: 1.0.1
Author URI: http://www.belocal.com/
*/
class BeLocalWidget extends WP_Widget
{
 /**
  * Declares the BeLocalWidget class.
  *
  */
    function BeLocalWidget(){
    $widget_ops = array('classname' => 'widget_belocal', 'description' => __( "BeLocal Wordpress Widget") );
    $this->WP_Widget('belocal', __('BeLocal Widget'), $widget_ops, $control_ops);
    }

  /**
    * Displays the Widget
    *
    */
    function widget($args, $instance){
      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
      $apiKey = empty($instance['apiKey']) ? '' : $instance['apiKey'];
      $postcode = empty($instance['postcode']) ? 'SW1 1AA' : $instance['postcode'];

      # Before the widget
      echo $before_widget;

      # Make the BeLocal widget
      echo '<div id="belocal_widget" api_key="'.$apiKey.'" loc="'.$postcode.'"><a href="http://www.belocal.com">BeLocal</a></div><script type="text/javascript" src="http://www.belocal.com/widget.js"></script>';

      # After the widget
      echo $after_widget;
  }

  /**
    * Saves the widgets settings.
    *
    */
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['postcode'] = strip_tags(stripslashes($new_instance['postcode']));
      $instance['apiKey'] = strip_tags(stripslashes($new_instance['apiKey']));

    return $instance;
  }

  /**
    * Creates the edit form for the widget.
    *
    */
    function form($instance){
      //Defaults
      $instance = wp_parse_args( (array) $instance, array('title'=>'', 'postcode'=>'', 'apiKey'=>'') );

      $title = htmlspecialchars($instance['title']);
      $postcode = htmlspecialchars($instance['postcode']);
      $apiKey = htmlspecialchars($instance['apiKey']);

      # Output the options
      //echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 100px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
      # Postcode
      echo '<p><label for="' . $this->get_field_name('postcode') . '">' . __('Postcode:') . ' <input style="width: 120px;" id="' . $this->get_field_id('postcode') . '" name="' . $this->get_field_name('postcode') . '" type="text" value="' . $postcode . '" /></label></p>';
      echo '<p><label for="' . $this->get_field_name('apiKey') . '">' . __('API Key:') . ' <input style="width: 120px;" id="' . $this->get_field_id('apiKey') . '" name="' . $this->get_field_name('apiKey') . '" type="text" value="' . $apiKey . '" /></label></p>';
  }

}// END class

/**
* Register BeLocal widget.
*
* Calls 'widgets_init' action after the BeLocal widget has been registered.
*/
function BeLocalInit() {
  register_widget('BeLocalWidget');
}
add_action('widgets_init', 'BeLocalInit');
?>