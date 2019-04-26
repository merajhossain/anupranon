<?php
add_action('admin_init','bq_megazine_meta_init');

function bq_megazine_meta_init()
{

	foreach (array('megazine') as $type) 
	{
		add_meta_box('bq_megazine_meta', 'Magazine Information', 'bq_megazine_meta_setup', $type, 'normal', 'high');
	}
	
	add_action('save_post','bq_megazine_meta_save');
}

function bq_megazine_meta_setup()
{
	global $post;
        
	// using an underscore, prevents the meta variable
	// from showing up in the custom fields section
	$meta = get_post_meta($post->ID,'_bq_megazine_meta',TRUE);
 
	// instead of writing HTML here, lets do an include
	include 'meta-form.php';
 
	// create a custom nonce for submit verification later
	echo '<input type="hidden" name="bq_megazine_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
function bq_megazine_meta_save($post_id) 
{
	// authentication checks

	// make sure data came from our meta box
	if (!wp_verify_nonce($_POST['bq_megazine_meta_noncename'],__FILE__)) return $post_id;

	// check user permissions
	if ($_POST['post_type'] == 'megazine') 
	{
		if (!current_user_can('edit_page', $post_id)) return $post_id;
	}
	else 
	{
		if (!current_user_can('edit_post', $post_id)) return $post_id;
	}

	// authentication passed, save data

	// var types
	// single: _abc_meta[var]
	// array: _abc_meta[var][]
	// grouped array: _abc_meta[var_group][0][var_1], _abc_meta[var_group][0][var_2]

	$current_data = get_post_meta($post_id, '_bq_megazine_meta', TRUE);	
	$new_data = $_POST['_bq_megazine_meta'];
		

	bq_meta_clean($new_data);
	
	if ($current_data) 
	{
		if (is_null($new_data)) delete_post_meta($post_id,'_bq_megazine_meta');
		else 
		{
                        update_post_meta($post_id,'_bq_megazine_meta',$new_data);
                        foreach($new_data as $single_meta_key=>$single_meta_data){
                            update_post_meta($post_id, $single_meta_key, $single_meta_data);
                        }
		}
	}
	elseif (!is_null($new_data))
	{
                add_post_meta($post_id,'_bq_megazine_meta',$new_data,TRUE);
                foreach($new_data as $single_meta_key=>$single_meta_data){
                    add_post_meta($post_id, $single_meta_key, $single_meta_data, TRUE);
                }
	}

	return $post_id;
}