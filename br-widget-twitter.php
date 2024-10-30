<?php
/*
 * Plugin Name: BR Twitter Widget
 * Version: 1.0
 * Plugin URI: http://kaus.com.br/twitter-widget/
 * Description: Ferramenta que permite ao usuário inserir um badge do Twitter.
 * Author: Kaus Midia
 * Author URI: http://kaus.com.br/
 */
class TwitterWidget extends WP_Widget
{
    function TwitterWidget(){
    $widget_ops = array('classname' => 'widget_twitter', 'description' => __( "Ferramenta que permite ao usuário inserir um badge do Twitter.") );
    $control_ops = array('width' => 300, 'height' => 300);
    $this->WP_Widget('twitter', __('BR Twitter'), $widget_ops, $control_ops);
    }

  /**
    * Exibe o Widget
    *
    */
    function widget($args, $instance){
      extract($args);
      $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);
      $username = empty($instance['username']) ? 'Usuario Twitter' : $instance['username'];
      $updates = empty($instance['updates']) ? 'Quantidade de updates' : $instance['updates'];

      # Codigos Before the widget
      echo $before_widget;

      # Titulo
      if ( $title )
      echo $before_title . $title . $after_title;

	  $html_output = "<div id='social'><div id='twitter_div'>";
	  $html_output = $html_output . "<ul id='twitter_update_list'></ul>";
	  $html_output = $html_output . "<a id='twitter-link' style='display:block;text-align:right;' href='http://twitter.com/" . $username . "'>Siga-me no Twitter</a></div>";
	  $html_output = $html_output . "<script src='" . get_bloginfo('wpurl') . "/wp-content/plugins/br-widget-twitter/js/twitter_badge.js' type='text/javascript'></script>";
	  $html_output = $html_output . "<script src='http://twitter.com/statuses/user_timeline/" . $username . ".json?callback=twitterCallback2&count=" . $updates . "' type='text/javascript'></script></div>";	  	 	  	  

	  # Exibe o conteúdo na página
	  echo $html_output;

      # Codigos após o widget
      echo $after_widget;
  }

  /**
    * Salva as configurações do widget.
    *
    */
    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));
      $instance['username'] = strip_tags(stripslashes($new_instance['username']));
      $instance['updates'] = strip_tags(stripslashes($new_instance['updates']));

    return $instance;
  }

  /**
    * Cria o Formulario de configuração do Widget.
    *
    */
    function form($instance){
      //Defaults
      $instance = wp_parse_args( (array) $instance, array('title'=>'', 'username'=>'', 'updates'=>'') );

      $title = htmlspecialchars($instance['title']);
      $username = htmlspecialchars($instance['username']);
      $updates = htmlspecialchars($instance['updates']);

      # Saida da Configuração do Widget
      echo '<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' &nbsp;&nbsp;&nbsp;<input style="width: 200px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
      echo '<p style="text-align:left;"><label for="' . $this->get_field_name('username') . '">' . __('Usuario:') . ' <input style="width: 200px;" id="' . $this->get_field_id('username') . '" name="' . $this->get_field_name('username') . '" type="text" value="' . $username . '" /></label></p>';
      echo '<p style="text-align:left;"><label for="' . $this->get_field_name('updates') . '">' . __('Quantidade de updates:') . ' <input style="width: 30px;" id="' . $this->get_field_id('updates') . '" name="' . $this->get_field_name('updates') . '" type="text" value="' . $updates . '" /></label></p>';
  }

}// END class

/**
  * Registra o Twitter Widget.
  * Chama função 'TwitterWidgetInit' assim que o Widget é registrado.
  */
  function TwitterWidgetInit() {
  	register_widget('TwitterWidget');
  }
  add_action('widgets_init', 'TwitterWidgetInit');
?>
