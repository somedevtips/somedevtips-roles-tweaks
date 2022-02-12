<?php
/**
 * Plugin Name: SomeDevTips Roles Tweaks
 * Plugin URI: https://github.com/somedevtips/somedevtips-roles-tweaks
 * Description: Adds to the standard 'Author' role the capability to manage the categories
 * Author: SomeDevTips
 * Version: 1.0.0
 * Author URI: https://somedevtips.com/
 */

defined( 'ABSPATH' ) OR exit;

register_activation_hook(__FILE__, array(SomeDevTipsRoleTweaks::class, 'onActivation'));
register_deactivation_hook(__FILE__, array(SomeDevTipsRoleTweaks::class, 'onDeactivation'));

class SomeDevTipsRoleTweaks
{
    public static function onActivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );

        $role_author = get_role( 'author' );
        $role_author->add_cap( 'manage_categories' );
    }

    public static function onDeactivation()
    {
        $role_author = get_role( 'author' );
        $role_author->remove_cap( 'manage_categories' );
    }
}
