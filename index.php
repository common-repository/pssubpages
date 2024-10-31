<?php
/*
    Plugin Name: psSubPages
    Plugin URI: 
    Description: Shows the child pages of the current page. Configurable title, show siblings, and "no child" text
    Author: Plaid Sheep
    Author URI: http://PlaidSheep.ca
    Version: 1.0.0

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once 'psSubPages.class.php';

/**
 * 
 */
function register_psSubPages_widget(){
	register_widget('pssubpages');
}

add_action('widgets_init','register_psSubPages_widget');

