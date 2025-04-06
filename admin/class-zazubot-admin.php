<?php
if (!defined('ABSPATH')) {
  exit();
}

class ZazuBot_Admin
{
  public function my_admin_menu()
  {
    add_menu_page(
      'ZazuBot Settings',
      'ZazuBot',
      'manage_options',
      'zazubot/settings.php',
      [$this, 'zazubot_settings_callback'],
      'dashicons-format-chat',
      250
    );
  }

  public function zazubot_settings_callback()
  {
    require_once 'partials/zazubot-admin-display.php';
  }

  public function register_zazubot_settings()
  {
    register_setting('zazubot', 'lib_version');
    register_setting('zazubot', 'init_snippet');
    register_setting('zazubot', 'excluded_pages');
  }
}
