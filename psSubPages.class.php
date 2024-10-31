<?php

/**
 * 
 */
class psSubPages extends WP_Widget 
{
	public function __construct() {
		parent::WP_Widget(
			'pssubpages', 
			__('Sub-pages'), 
			array('description'=>'', 'class'=>'subpagewidget')
		);
	}
	
	/**
	 * 
	 * @param type $instance
	 */
	public function form($instance)
	{
		$default = array( 
			'title' => __('Sub-pages'),
			'nothing'=> __('No Sub-pages'),
			'sibling'=> false
			);
		$instance = wp_parse_args( (array)$instance, $default );
		echo "\r\n";
		echo "<p>";
		echo "<label for='".$this->get_field_id('title')."'>" . __('Title') . ":</label> " ;
		echo "<input type='text' class='widefat' id='".$this->get_field_id('title')."' name='".$this->get_field_name('title')."' value='" . esc_attr($instance['title'] ) . "' />" ;
		echo "</p>";
		echo "<p>";
		echo "<label for='".$this->get_field_id('nothing')."'>" . __('No Sub-pages') . ":</label> " ;
		echo "<input type='text' class='widefat' id='".$this->get_field_id('nothing')."' name='".$this->get_field_name('nothing')."' value='" . esc_attr( $instance['nothing'] ) . "' placeholder='Text to display if nothing to display' />" ;
		echo "</p>";
		echo "<p>";
		echo "<label for='".$this->get_field_id('sibling')."' style='display:inline;'>" . __('Siblings') . ":</label> " ;
		echo "<input type='checkbox' class='checkbox' id='".$this->get_field_id('sibling')."' name='".$this->get_field_name('sibling')."' value='showsibling' " . (esc_attr($instance['sibling'])=='showsibling'?'checked':'') . " placeholder='Text to display if nothing to display' />" ;
		echo "</p>";
	}
	
	/**
	 * 
	 * @param type $new_instance
	 * @param type $old_instance
	 * @return type
	 */
	public function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nothing'] = strip_tags($new_instance['nothing']);
		$instance['sibling'] = strip_tags($new_instance['sibling']);
		return $instance;
	}
	
	/**
	 * Renders the actual widget
	 * 
	 * @global post $post
	 * @param array $args 
	 * @param type $instance
	 */
	public function widget($args, $instance) 
	{
		extract($args, EXTR_SKIP);
		global $post;
		$pages = get_pages(array(
				'child_of' => $post->ID,
				'parent' => $post->ID,
				'sort_column' => 'menu_order'
			));
		
		// Show the sibling pages if there are no children
		if(0 == count($pages) && $post->post_parent && $instance['sibling']) { 
			$pages = get_pages(array(
				'child_of' => $post -> post_parent,
				'parent' => $post -> post_parent,
				'sort_column' => 'menu_order'
			));
		}
		
		// if there is something to display
		if(0 < count($pages) || $instance['nothing']){
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
			if(count($pages)){
				echo "<ul>";
				foreach($pages as $page){
					$styleCurPage = (get_queried_object_id() === $page->ID)?'current_page_item':'';
					echo "<li class='${styleCurPage}'><a href='".get_permalink($page->ID)."'>".get_the_title($page->ID)."</a></li>";
				}
				echo "</ul>";
			}
			else{
				echo $instance['nothing'];
			}
			echo $after_widget;
		}
	}
}

