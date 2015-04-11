<?php
/**
 * @package  GistPress
 */
?>
<div class="wrap">
	<h2><?php _e( 'GistPress settings', self::SLUG ); ?></h2>

	<h3><?php _e( 'GistPress defaults', self::SLUG ); ?></h3>

	<form action="options-general.php?page=<?php echo self::SETTINGS_PAGE_ID; ?>" method="post" id="gistpress_defaults_form">
		<input type="hidden" name="action" value="<?php echo self::SLUG.'-defaults'; ?>" />
		<?php wp_nonce_field(self::SLUG.'-defaults-verify'); ?>
		<table class="form-table">
		<tr>
			<th scope="row"><label for="<?php echo self::SLUG.'-default-highlight_color' ?>"><?php _e( 'Default highlight color', self::SLUG ); ?></label></th>
			<td><input name="<?php echo self::SLUG.'-default-highlight_color'; ?>" id="<?php echo self::SLUG.'-default-highlight_color'; ?>" value="<?php echo  $settings['highlight_color']; ?>" /></td>
		</tr>
		<tr>
			<th scope="row"><?php echo _e( 'Other settings', self::SLUG ); ?></th>
			<td><fieldset>
				<legend class="screen-reader-text"><span><?php echo _e( 'Other settings', self::SLUG ); ?></span></legend>
				<label for="<?php echo self::SLUG.'-default-embed_stylesheet' ?>">
					<input type="checkbox" name="<?php echo self::SLUG.'-default-embed_stylesheet'; ?>" id="<?php echo self::SLUG.'-default-embed_stylesheet'; ?>" value="true"<?php if ( $settings['embed_stylesheet'] ) { echo ' checked="checked"'; } ?> />
					<?php _e( 'Include default stylesheet or not', self::SLUG ); ?>
				</label><br />
				<label for="<?php echo self::SLUG.'-default-show_line_numbers' ?>">
					<input type="checkbox" name="<?php echo self::SLUG.'-default-show_line_numbers'; ?>" id="<?php echo self::SLUG.'-default-show_line_numbers'; ?>" value="true"<?php if ( $settings['show_line_numbers'] ) { echo ' checked="checked"'; } ?> />
					<?php _e( 'Whether line numbers should be displayed', self::SLUG ); ?>
				</label><br />
				<label for="<?php echo self::SLUG.'-default-show_meta' ?>">
					<input type="checkbox" name="<?php echo self::SLUG.'-default-show_meta'; ?>" id="<?php echo self::SLUG.'-default-show_meta'; ?>" value="true"<?php if ( $settings['show_meta'] ) { echo ' checked="checked"'; } ?> />
					<?php _e( 'Whether the meta links following a gist should be displayed', self::SLUG ); ?>
				</label><br />
				<p class="description"><?php _e( '(These settings may be overridden for individual shortcodes.)', self::SLUG ); ?></p>
			</fieldset></td>
		</tr>
		</table>
		<?php submit_button( __('Save Changes', self::SLUG ) ); ?>
	</form>
</div>