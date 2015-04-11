<?php
/**
 * Page renders the default help.
 */
?>
<p><?php 
	_e( 'The fields on this screen are responsible for setting the default properties of the <code>[gist]</code> shortcode. The parameters can be overridden in the individual shortcodes:', self::SLUG);
?></p>
<ul>
	<li><?php _e( '<code>highlight_color</code>: The background color to use when highlighting lines (originally <code>#fcc</code>).', self::SLUG ); ?></li>
	<li><?php _e( '<code>default_stylesheet</code>: Whether or not to include a copy of the default GitHub gist stylesheet on the page. All uses of gist must be false to not include a copy (originally <code>true</code>).', self::SLUG ); ?></li>
	<li><?php _e( '<code>show_line_numbers</code>: Whether or not to show the line numbers on code output (originally <code>true</code>).', self::SLUG ); ?></li>
	<li><?php _e( '<code>show_meta</code>:Whether or not to show the meta links following a gist (originally <code>true</code>).', self::SLUG ); ?></li>
</ul>