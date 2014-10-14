<?php
/**
 * MonoBook nouveau. tweaked by tuxun...
 * http://www.gnu.org/copyleft/gpl.html
 * @file
 * @ingroup Skins
 */

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @ingroup Skins
 */
class Skinfunlab extends SkinTemplate {
	/** Using MonoBook. */
	public $skinname = 'funlab';
	public $stylename = 'funlab';
	public $template = 'funlabTemplate';

	/**
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addModuleStyles( array(
			'mediawiki.skinning.interface',
			'mediawiki.skinning.content.externallinks',
			'skins.funlab.styles'
		) );

		// TODO: Migrate all of these
		$out->addStyle( $this->stylename . '/IE60Fixes.css', 'screen', 'IE 6' );
		$out->addStyle( $this->stylename . '/IE70Fixes.css', 'screen', 'IE 7' );
	}
}
