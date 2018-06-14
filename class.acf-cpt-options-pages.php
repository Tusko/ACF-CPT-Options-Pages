<?php
class ACFCPT_OptionsPages {

	function __construct() {
		//Check if installed ACF Options Page
		if ( function_exists( 'acf_add_options_page' ) ) {
			$this->init();
		} else {
			add_action( 'admin_notices', array( $this, 'admin_error_notice' ) );
		}
	}

	public function init(){
		add_filter( 'plugin_action_links_' . CPT_ACF_PLUGIN, array($this, 'plugin_action_links') );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ), 100, 3 );
		add_action( 'admin_menu', array($this, 'options_page_render') );
		$this->setup_cpt_options_pages();
	}

	public function admin_error_notice() {
		echo '<div class="update-nag"><p>' . __( 'Admin Error Notice', CPT_ACF_DOMAIN ) . '</p></div>';
	}

	public function load_plugin_textdomain() {
		load_plugin_textdomain( CPT_ACF_DOMAIN, false, CPT_ACF_DOMAIN . '/languages' );
	}

	public function plugin_action_links($links) {
		$links[] = '<a href="'.admin_url('edit.php?post_type=acf-field-group&page=' . CPT_ACF_DOMAIN . '-settings').'" target="_blank">' . __( 'Settings', CPT_ACF_DOMAIN ) . '</a>';
		$links[] = '<a href="https://github.com/Tusko/ACF-CPT-Options-Pages#usage" target="_blank">' . __( 'Documentation', CPT_ACF_DOMAIN ) . '</a>';
		return $links;
	}

	public function options_page_render(){
		$hook = add_submenu_page( 'edit.php?post_type=acf-field-group', __('CPT Options Pages', CPT_ACF_DOMAIN), __('CPT Options Pages', CPT_ACF_DOMAIN), 'manage_options', CPT_ACF_DOMAIN . '-settings', array($this, 'options_page_tpl') );
		add_action( "load-$hook", function() {
			wp_enqueue_script( 'acf_cpt_logic', CPT_ACF_PLUGIN_DIR . 'assets/acf-cpt-logic.js' );
		} );
	}

	public function options_page_tpl() {
	    include 'tpl-settings-page.php';
    }

    public function get_custom_post_types(){
        return get_post_types( array(
	        '_builtin'    => false,
	        'has_archive' => true
        ) );
    }

    public function get_registered_cpts(){
        $get_cpts_enabled = get_option('acf-cpt-archives');
        $cpts_enabled = unserialize($get_cpts_enabled);

        return $cpts_enabled;
    }

    public function register_post_type_options_page($name, $cpt) {
        $cpt_id   = 'cpt_' . $cpt;
        $slug     = ($name !== $cpt ? '_' . strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $name)) : '');

	    $cpt_id = $cpt_id . $slug;

	    if( defined('ICL_LANGUAGE_CODE') ) {
		    $cpt_id = $cpt_id . '_' . ICL_LANGUAGE_CODE;
	    }

        $cpt_acf_page = array(
	        'parent_slug' => 'edit.php?post_type=' . $cpt,
	        'capability'  => 'edit_posts',
	        'post_id'     => $cpt_id,
	        'position'    => false,
	        'icon_url'    => false,
	        'redirect'    => false
        );

        $cpt_acf_custom = array(
	        'page_title'  => sprintf( __( '%s Options', CPT_ACF_DOMAIN ), ucfirst( $name ) ),
	        'menu_title'  => sprintf( __( '%s Options', CPT_ACF_DOMAIN ), ucfirst( $name ) ),
	        'menu_slug'   => $slug .'-'. $cpt . '-options',
	        'capability'  => 'edit_posts',
        );

        $cpt_acf_custom = apply_filters( "{$cpt_id}_acf_page_args", $cpt_acf_custom );
        $cpt_acf_page = array_merge($cpt_acf_page, $cpt_acf_custom);

        acf_add_options_page( $cpt_acf_page );
    }

    public function setup_cpt_options_pages(){
		$registered = $this->get_registered_cpts();
		if(empty($registered)) {
			$registered = $this->get_custom_post_types();
		}

		unset($registered["0"]);

        foreach ( $registered as $k => $v ) {
			if(!is_array($v) && post_type_exists( $v )) {
				$this->register_post_type_options_page($v, $v);
			} else {
				foreach ( $v as $sub ) {
		            $this->register_post_type_options_page($sub, $k);
				}
			}
        }
    }

}