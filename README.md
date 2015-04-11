# GistPress3 #

**Contributors:** tychay, [Brady Vercher](https://github.com/bradyvercher), [Gary Jones](https://github.com/GaryJones)  
**Requires at least:** 3.5.0  
**Tested up to:** 4.1.1  
**Stable tag:** trunk  
**License:** [GPL-2.0+](http://www.gnu.org/licenses/gpl-2.0.html)  
tags: gist, oembed, gistpress  

Extend Wordpress to create a bidirectional embed Gists via oEmbed or shortcode.

## Description ##

GitHub provides a method for embedding Gists on websites, but it requires inserting a `<script>` tag, which can become mangled or stripped from the TinyMCE editor used in WordPress. Instead, this plugin allows you to embed a Gist by simply inserting its URL into the editor for oEmbed-like support, or via a shortcode for more refined control.

###Features###

* Better integration with the visual editor in WordPress since `<script>` tags aren't used, which also allows visitors without JavaScript to view your code snippets.
* Users viewing your content in a feed reader will see a link directly to the Gist instead of nothing.
* Limit which lines from a Gist are displayed. Helpful for breaking down code so it can be easily explained.
* Highlight specific lines within a Gist to call attention to them.
* Easily debug embedded Gists using a custom panel for the [Debug Bar](http://wordpress.org/extend/plugins/debug-bar/) plugin.
* A few additional CSS classes are inserted for better styling hooks.

In addition GistPress3 adds the following:

* Backwardly compatible with JetPack/WordPress.com-style shortcodes 
  * bare url in attributes
  * id in content
  * url in content
* Allows arbitrary content to be put in shortcode (and removed in output)
* Disable JetPack and oEmbed Gist plugin handling by default
* Support for `url###""` substitute for `id###""` in shortcodes (oEmbed Gist-style)
* Non-parsed gist shortcodes are simply passed through (adds a comment)
* Supports revision sha1 linking, alsoo through `revision=""` in shortcode
* Settings page (with help tab) in Admin for configuring defaults.

TODO:

* Support for "gistpress" shortcode via API upload

## Installation ##

### Warning ###

You cannot have GistPress and GistPress3 installed and active at the same
time as the function and class names overlap.

### Installing the Plugin ###

Automatic:

1. Choose `Plugins > Add New…`
2. Search for "GistPress"
3. Click on "GistPress3"
4. Click "Install Now"

Upload:

1. Download the [latest release](https://github.com/tychay/gistpress/archive/master.zip) from GitHub.
2. Go to the __Plugins &rarr; Add New__ screen in your WordPress admin panel and click the __Upload__ tab at the top.
3. Upload the zipped archive.
4. Click the __Activate Plugin__ link after installation completes.

Manual:

1. Download the [latest release](https://github.com/bradyvercher/gistpress/archive/master.zip) from GitHub.
2. Unzip the archive.
3. Copy the folder to `/wp-content/plugins/`.
4. Go to the __Plugins__ screen in your WordPress admin panel and click the __Activate__ link under GistPress.

Read the Codex for more information about [installing plugins manually](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

Git:

1. Navigate to `/wp-content/plugins/`
2. Clone repository: `git clone git@github.com:tychay/gistpress.git`
3. Go to the __Plugins__ screen in your WordPress admin panel and click the __Activate__ link under GistPress.

### Updating ###

Automatically installed plugins can be updated via the "Automatic" method above.

Although it's not a regular occurrence, GitHub may introduce new features or changes that break the way this plugin works. In such cases, it's important to receive notifications and be able to easily update with the latest fixes. Fortunately, there are a couple of options you can install to manage updates from GitHub-hosted plugins:

* [Git Plugin Updates](https://github.com/brainstormmedia/git-plugin-updates)
* [GitHub Updater](https://github.com/afragen/github-updater)

###Using the plugin###

####oEmbed####

Insert the URL to a Gist on its own line like this (don't link it up):

`https://gist.github.com/9b1307f153f4abe352a4`

That's it!

_Notice that URL is for a secret Gist? Of course URLs for public Gists work, too._

####Shortcode####

Using the same URL from above, the shortcode equivalent would look like this:

`[gist id="9b1307f153f4abe352a4"]`

In both cases, that will embed all four files in the example Gist, however, with the shortcode, you have the option to limit the display to a single file by specifiying its name:

`[gist id###"9b1307f153f4abe352a4" file###"media-control-snippet.php"]`

Taking it further, you can limit display to specific lines within a file:

`[gist id###"9b1307f153f4abe352a4" file###"media-control-snippet.php" lines="2-5"]`

Or even highlight lines:

`[gist id###"9b1307f153f4abe352a4" file###"media-control-snippet.php" highlight="7"]`

<table><caption><h3>Shortcode Attributes</strong></h3>
  <thead>
    <tr>
      <th>Attribute</th>
      <th>Description</th>
      <th>Example</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      <td><strong><code>id</code></strong></td>
      <td>A Gist ID. Required. Secret Gist IDs work, too.</td>
      <td><em><code>4204333</code></em></td>
    </tr>
    <tr>
      <td><strong><code>url</code></strong></td>
      <td>Can be used in place of id, file, and revision. Required if id is misssing.</td>
      <td><em><code>https://gist.github.com/padolsey/527683</code></em></td>
    </tr>
    <tr>
      <td><strong><code>file</code></strong></td>
      <td>A filename in a Gist. Required when using the following attributes with a multi-file Gist.</td>
      <td><em><code>filename.php</code></em></td>
    </tr>
    <tr>
      <td><strong><code>revision</code></strong></td>
      <td>Allows linking of specific revision instead of latest</td>
      <td><em><code>eea6004e74dfd42a63cc3b46e1412a3c8d5bb680</code></em></td>
    </tr>
	<tr>
		<td><strong><code>highlight</code></strong></td>
		<td>Comma-separated list of lines or line ranges to highlight.</td>
		<td><em><code>1,5-10,13</code></td>
	</tr>
	<tr>
	  <td><strong><code>highlight_color</code></strong></td>
	  <td>The highlight color. A filter is provided for changing globally.</td>
	  <td><em><code>#ff0000</code></em></td>
	</tr>
    <tr>
      <td><strong><code>lines</code></strong></td>
      <td>The range of lines to display.</td>
	  <td><em><code>2-10</code></em></td>
    </tr>
	<tr>
	  <td><strong><code>lines_start</code></strong></td>
	  <td>Number to start lines at.</td>
	  <td><em><code>543</code></em></td>
	</tr>
	<tr>
      <td><strong><code>show_line_numbers</code></strong></td>
      <td>Whether line numbers should be displayed. Defaults to true.</td>
	  <td><em><code>0</code> to disable.</em></td>
    </tr>
	<tr>
      <td><strong><code>show_meta</code></strong></td>
      <td>Whether the meta links following a Gist should be displayed. Defaults to true.</td>
      <td><em><code>0</code> to disable.</em></td>
    </tr>
  </tbody>
</table>

## Screenshots ##

![](screenshot-1.png)
Example Gist embed with line number restrictions, a highlighted line, and meta links disabled.

## Notes ##

Some themes may include styles that interfere with the default rules for embedded Gists. You can override the conflicting styles in your theme's (or [child theme's](http://codex.wordpress.org/Child_Themes)) style sheet with more specific rules targetting the embed HTML. Typically, this might include removing margins on `<pre>` elements, changing padding on the table cells, and ensuring the `line-height` and `font-size` properties for line numbers and code match so they align properly.

### Highlighting ###

To support line highlighting, an inline style is added by the plugin, however, a class is also added to the line element. Developers can add a CSS rule similar to the following to their theme style sheet in order to change the color:

```css
.line-highlight {
    background-color: #ffc !important;
}
```

And the following would go in the theme's functions.php to disable the `style` attribute.

```php
add_filter( 'gistpress_highlight_color', '__return_false' );
```


### Caching ###

Embedded Gists are cached using a custom algorithm that minimizes HTTP requests and ensures your code snippets continue to display even if GitHub is down. If you need to update the snippet with changes made on GitHub, just update the post and the cache will be refreshed.

If you decide you don't want to use the plugin, simply uninstall using the "Delete" link on the Plugins screen, and all cached data and options will be cleaned up. Like it never even existed.

## Changelog ##

**Version 3.0**

* First release of GitPress3 (bi-directional support)
* oEmbed supports revision sha1's
* Shortcode attributes supports: bare url (Jetpack-style), `url` (oEmbed Gist-style), and `revision`
* Shortcode content supports: bare url & id (Jetpack-style), arbitrary stuff to ignore (Gangnam-style)
* Plays nice/mean with similar plugins: disables JetPack, oEmbed Gist
* New Settings page (with help) added: set defaults.
* Numerous small bugfixes, refactors and other improvements

**Version 2.03**

* Forked from  2.03 built by [Brady Vercher](https://twitter.com/bradyvercher) & [Gary Jones](https://twitter.com/GaryJ). See [Changelog](https://github.com/tychay/gistpress/blob/develop/CHANGELOG.md)
