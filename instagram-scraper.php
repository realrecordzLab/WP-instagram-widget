<?php
/*
* Plugin Name: Instagram feed scraper
* Version: 1.0
* Author: Bruno Paolillo
*/

class InstagramFeedWidget extends WP_Widget {

  public $url;

  public function __construct()
  {
    parent::__construct(
      'instagram-widget',
      'Instagram feed',
      array(
        'description' => ''
      )
    );
    add_action( 'widgets_init', array($this, 'init') );
    add_action( 'wp_enqueue_scripts', array($this, '_res' ) );
  }

  public function init()
  {
    register_sidebar(
      array(
        'name'        =>  'Instagram feed',
        'id'          =>  'ig-feed',
        'description' =>  'Instagram feed widget',
      )
    );
    register_widget( 'InstagramFeedWidget' );
  }

  public function _res()
  {
    wp_enqueue_style('instagram-widget', plugins_url( 'instagram-widget.min.css', __FILE__), array('swiper'), null);
    $data = $this->get_settings();
    $localized = array(
      'profile_url' => 'https://instagram.com/'.$data[2]['username'].'?__a=1'
    );
    wp_localize_script('instagram-widget-js', 'igfeed', $localized );
    wp_enqueue_script('instagram-widget-js', plugins_url( 'instagram-widget.js', __FILE__), array('swiper'), null);
  }

  public function widget( $args, $instance )
  {

    ?>
      <div class="swiper-container swiper-feed" id="ig-feed">
        <div class="swiper-wrapper">
          <div v-for="img in feedImg" class="swiper-slide feed-img" v-bind:style="{ backgroundImage: 'url('+img.url+')' }" /></div>
        </div>
        <div class="swiper-button-prev "></div>
        <div class="swiper-button-next"></div>
      </div>
    <?php
  }

  public function form( $instance )
  {
    $username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
    ?>
    <p>
    <label for="<?php esc_attr( $this->get_field_id('username') ); ?>"><?php _e('Username'); ?></label>
    <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('username') ); ?>" name="<?php echo esc_attr( $this->get_field_name('username') ); ?>" value="<?php echo esc_attr($username); ?>">
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance )
  {
    $instance = $old_instance;

    $instance['username'] = esc_attr($new_instance['username']);

    return $instance;
  }

}

new InstagramFeedWidget;
?>
