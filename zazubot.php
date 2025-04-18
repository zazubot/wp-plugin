<?php

/**
 * Plugin Name:       zazubot
 * Description:       Together, we're hacking the future of conversational AI apps.
 * Version:           4.2.0
 * Author:            ZazuBot
 * Author URI:        http://zazubot.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zazubot
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
  die();
}

define('ZAZUBOT_VERSION', '4.2.0');

function activate_zazubot()
{
  require_once plugin_dir_path(__FILE__) .
    'includes/class-zazubot-activator.php';
  Zazubot_Activator::activate();
}

function deactivate_zazubot()
{
  require_once plugin_dir_path(__FILE__) .
    'includes/class-zazubot-deactivator.php';
  Zazubot_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_zazubot');
register_deactivation_hook(__FILE__, 'deactivate_zazubot');

require plugin_dir_path(__FILE__) . 'includes/class-zazubot.php';

function run_zazubot()
{
  $plugin = new Zazubot();
  $plugin->run();
}
run_zazubot();
