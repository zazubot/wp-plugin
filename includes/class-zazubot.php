<?php

class Zazubot
{

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct()
	{
		if (defined('ZAZUBOT_VERSION')) {
			$this->version = ZAZUBOT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'zazubot';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies()
	{

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-zazubot-loader.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-zazubot-i18n.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-zazubot-admin.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-zazubot-public.php';

		$this->loader = new Zazubot_Loader();
	}

	private function set_locale()
	{
		$plugin_i18n = new Zazubot_i18n();
		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	private function define_admin_hooks()
	{
		$plugin_admin = new Zazubot_Admin($this->get_version());
		$this->loader->add_action('admin_menu', $plugin_admin, 'my_admin_menu');
		$this->loader->add_action('admin_init', $plugin_admin, 'register_zazubot_settings');
	}

	private function define_public_hooks()
	{
		$plugin_public = new Zazubot_Public($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'add_head_code');
		$this->loader->add_shortcode('zazubot', $plugin_public, 'add_zazubot_container');
	}

	public function run()
	{
		$this->loader->run();
	}

	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	public function get_loader()
	{
		return $this->loader;
	}

	public function get_version()
	{
		return $this->version;
	}
}
