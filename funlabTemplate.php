<?php
/**
 * MonoBook nouveau.
 *
 * Translated from gwicke's previous TAL template version to remove
 * dependency on PHPTAL.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * @ingroup Skins
 */

include "fcts.php";

class funlabTemplate extends BaseTemplate {

	/**
	 * Template filter callback for MonoBook skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */

	function execute() {
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		//$this->html( 'headelement' );
		$this->headBox();

		?><div id="globalWrapper"><?php  funlabTemplateAPI::banner($this->msg,$this->html,$this->data);?>

<div id="content" class="mw-body" role="main">
		<?php	include "funbar.php";?>


			
<?php $this->cactions(); ?>			<?php 
$this->renderPortals( $this->data['sidebar'] );					
?>


			


				<?php
				if ( $this->data['sitenotice'] ) {
					?>
					<div id="siteNotice"><?php
					$this->html( 'sitenotice' )
					?></div><?php
				}
				?>
		</div>		


<!-- start p-perso -->
		

<div class="portlet" id="p-personal" role="navigation">
	
			<h3><?php $this->msg( 'personaltools' ) ?></h3>

				<div class="pBody">
					<ul<?php $this->html( 'userlangattributes' ) ?>>
						<?php foreach ( $this->getPersonalTools() as $key => $item ) { ?>
							<?php echo $this->makeListItem( $key, $item ); 

						
}

		?>
					</ul>
<a id="top"></a>
			</div>	
<!-- end p-perso -->


<h1 id="firstHeading" class="firstHeading" lang="<?php
				$this->data['pageLanguage'] =
					$this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
				$this->text( 'pageLanguage' );
				?>"><span dir="auto"><?php $this->html( 'title' ) ?></span></h1>
			</div>	
				<!-- end of the left (by default at least) column		<div class="visualClear"></div> -->


		<?php
 funlabTemplateAPI::pmwcontent($this->msg,$this->html,$this->data);
		$this->printTrail();
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
		echo "\n";
		wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/
	

	/**
	 * @param array $sidebar
	 */
	protected function renderPortals( $sidebar ) {

		if ( !isset( $sidebar['SEARCH'] ) ) {

		}
		if ( !isset( $sidebar['TOOLBOX'] ) ) {
			$sidebar['TOOLBOX'] = true;
		}
		if ( !isset( $sidebar['LANGUAGES'] ) ) {
			$sidebar['LANGUAGES'] = true;
		}

		foreach ( $sidebar as $boxName => $content ) {
			if ( $content === false ) {
				continue;
			}

			if ( $boxName == 'SEARCH' ) {
				$this->searchBox();
			} elseif ( $boxName == 'TOOLBOX' ) {
				$this->toolbox();
			} elseif ( $boxName == 'LANGUAGES' ) {
				$this->languageBox();
			} else {
				$this->customBox( $boxName, $content );
			}
		}
	}

	function searchBox() {
		?>
		<div id="p-search" class="portlet" role="search">
			<h3><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h3>

			<div id="searchBody" class="pBody">
				<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
					<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
					<?php echo $this->makeSearchInput( array( "id" => "searchInput" ) ); ?>

					<?php
					echo $this->makeSearchButton(
						"go",
						array( "id" => "searchGoButton", "class" => "searchButton" )
					);

					if ( $this->config->get( 'UseTwoButtonsSearchForm' ) ) {
						?>&#160;
						<?php echo $this->makeSearchButton(
							"fulltext",
							array( "id" => "mw-searchButton", "class" => "searchButton" )
						);
					} else {
						?>

						<div><a href="<?php
						$this->text( 'searchaction' )
						?>" rel="search"><?php $this->msg( 'powersearch-legend' ) ?></a></div><?php
					} ?>

				</form>

				<?php $this->renderAfterPortlet( 'search' ); ?>
			</div>
		</div>
	<?php
	}

	/**
	 * Prints the cactions bar.
	 * Shared between MonoBook and Modern
	 */
	function cactions() {
include "cactions.php";
?>

</ul>

</li>
</ul>				
				<?php $this->renderAfterPortlet( 'cactions' ); ?>
			</div>
		</div>
	<?php
	}

	/*************************************************************************************************/
	function toolbox() {
		?>
		<div class="portlet" id="p-tb" role="navigation">
			<h3><?php $this->msg( 'toolbox' ) ?></h3>

			<div class="pBody">
				<ul>
					<?php
					foreach ( $this->getToolbox() as $key => $tbitem ) {
						?>
						<?php echo $this->makeListItem( $key, $tbitem ); ?>

					<?php
					}
					wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
					wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this, true ) );
					?>
				</ul>
				<?php $this->renderAfterPortlet( 'tb' ); ?>
			</div>
		</div>
	<?php
	}

	/*************************************************************************************************/
	function languageBox() {
		if ( $this->data['language_urls'] !== false ) {
			?>
			<div id="p-lang" class="portlet" role="navigation">
				<h3<?php $this->html( 'userlangattributes' ) ?>><?php $this->msg( 'otherlanguages' ) ?></h3>

				<div class="pBody">
					<ul>
						<?php foreach ( $this->data['language_urls'] as $key => $langlink ) { ?>
							<?php echo $this->makeListItem( $key, $langlink ); ?>

						<?php
}
						?>
					</ul>

					<?php $this->renderAfterPortlet( 'lang' ); ?>
				</div>
			</div>
		<?php
		}
	}

	/*************************************************************************************************/
	/**
	 * @param string $bar
	 * @param array|string $cont
	 */
function headBox() {
include "header.php";

include "headerfun.php";include "headerwiki.php";		
include "head.php";

}
	function customBox( $bar, $cont ) {
		$portletAttribs = array(
			'class' => 'generated-sidebar portlet',
			'id' => Sanitizer::escapeId( "p-$bar" ),
			'role' => 'navigation'
		);

		$tooltip = Linker::titleAttrib( "p-$bar" );
		if ( $tooltip !== false ) {
			$portletAttribs['title'] = $tooltip;
		}
		echo '	' . Html::openElement( 'div', $portletAttribs );
		$msgObj = wfMessage( $bar );
		?>

		<h3><?php echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $bar ); ?></h3>
		<div class='pBody'>
			<?php
			if ( is_array( $cont ) ) {
				?>
				<ul>
					<?php
					foreach ( $cont as $key => $val ) {
						?>
						<?php echo $this->makeListItem( $key, $val ); ?>

					<?php
					}
					?>
				</ul>
			<?php
			} else {
				# allow raw HTML block to be defined by extensions
				print $cont;
			}

			$this->renderAfterPortlet( $bar );
			?>
		</div>
		</div>
	<?php
	}
} // end of class
