<?php 

function admin_notice_missing_main_plugin() {

  if ( function_exists( 'elementor_pro_load_plugin' ) ) {
    return;
  }   

  $screen = get_current_screen();
  if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
    return;
  }

  $plugin = 'elementor/elementor.php';
  $installed_plugins = get_plugins();
  $is_elementor_installed = isset( $installed_plugins[ $plugin ] );


  if ( !$is_elementor_installed ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return;
    }

    $message = __( 'Elementor Template Shortcode helps to display Elementor Builder Content.', 'hello-elementor' );

    $button_text = __( 'Install Elementor', 'hello-elementor' );
    $button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

    // update_user_meta( get_current_user_id(), '_hello_elementor_install_notice', 'false' );

  } elseif ( !is_plugin_active( $plugin ) ) {
    
    if ( ! current_user_can( 'activate_plugins' ) ) {
      return;
    }

    $message = __( 'Elementor Template Shortcode helps to display Elementor Builder Content.', 'hello-elementor' );

    $button_text = __( 'Activate Elementor', 'hello-elementor' );
    $button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
  } 

  ?>
  <style>
    .notice.hello-elementor-notice {
      border-left-color: #9b0a46 !important;
      padding: 20px;
    }
    .rtl .notice.hello-elementor-notice {
      border-right-color: #9b0a46 !important;
    }
    .notice.hello-elementor-notice .hello-elementor-notice-inner {
      display: table;
      width: 100%;
    }
    .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-notice-icon,
    .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-notice-content,
    .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-install-now {
      display: table-cell;
      vertical-align: middle;
    }
    .notice.hello-elementor-notice .hello-elementor-notice-icon {
      color: #9b0a46;
      font-size: 50px;
      width: 50px;
    }
    .notice.hello-elementor-notice .hello-elementor-notice-content {
      padding: 0 20px;
    }
    .notice.hello-elementor-notice p {
      padding: 0;
      margin: 0;
    }
    .notice.hello-elementor-notice h3 {
      margin: 0 0 5px;
    }
    .notice.hello-elementor-notice .hello-elementor-install-now {
      text-align: center;
    }
    .notice.hello-elementor-notice .hello-elementor-install-now .hello-elementor-install-button {
      padding: 5px 30px;
      height: auto;
      line-height: 20px;
      text-transform: capitalize;
    }
    .notice.hello-elementor-notice .hello-elementor-install-now .hello-elementor-install-button i {
      padding-right: 5px;
    }
    .rtl .notice.hello-elementor-notice .hello-elementor-install-now .hello-elementor-install-button i {
      padding-right: 0;
      padding-left: 5px;
    }
    .notice.hello-elementor-notice .hello-elementor-install-now .hello-elementor-install-button:active {
      transform: translateY(1px);
    }
    @media (max-width: 767px) {
      .notice.hello-elementor-notice {
        padding: 10px;
      }
      .notice.hello-elementor-notice .hello-elementor-notice-inner {
        display: block;
      }
      .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-notice-content {
        display: block;
        padding: 0;
      }
      .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-notice-icon,
      .notice.hello-elementor-notice .hello-elementor-notice-inner .hello-elementor-install-now {
        display: none;
      }
    }
  </style>

  <div class="notice updated is-dismissible hello-elementor-notice hello-elementor-install-elementor">
    <div class="hello-elementor-notice-inner">
<!--       <div class="hello-elementor-notice-icon">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/elementor-logo.png' ); ?>" alt="Elementor Logo" />
      </div> -->

      <div class="hello-elementor-notice-content">
        <h3><?php esc_html_e( 'Thanks for installing Elementor Template Shortcode!', 'hello-elementor' ); ?></h3>
        <p><?php echo esc_html( $message ); ?></p>
      </div>

      <div class="hello-elementor-install-now">
        <a class="button button-primary hello-elementor-install-button" href="<?php echo esc_attr( $button_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html( $button_text ); ?></a>
      </div>
    </div>
  </div>
  <?php
}

