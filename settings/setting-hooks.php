<?php
function remove_admin_menus()
{
	global $menu;

	$restricted = array('リンク', 'コメント');

	if (is_array($menu)) {
		end($menu);

		while (prev($menu)){
			$value = explode(' ',$menu[key($menu)][0]);

			if(in_array($value[0] != null ? $value[0] : "" , $restricted)){
				unset($menu[key($menu)]);
			}
		}
	}
}

add_action('admin_init', 'remove_admin_menus');