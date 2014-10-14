<?php
/**
  * MonoBook nouveau. tweaked by tuxun...
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup Skins
 */

/**
 * @ingroup Skins
 */
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
				$this->renderPortals( 'headBox' );		
?><div id="globalWrapper">
<?php


		// $this->renderPortals( $this->data['sidebar'] );
			?>
		<div id="column-content">
			<div id="content" class="mw-body" role="main">
				<a id="top"></a>
				<?php
				if ( $this->data['sitenotice'] ) {
					?>
					<div id="siteNotice"><?php
					$this->html( 'sitenotice' )
					?></div><?php
				}
				?>

				<h1 id="firstHeading" class="firstHeading" lang="<?php
				$this->data['pageLanguage'] =
					$this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
				$this->text( 'pageLanguage' );
				?>"><span dir="auto"><?php $this->html( 'title' ) ?></span></h1>

				<div id="bodyContent" class="mw-body-content">

					<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>
					<div id="contentSub"<?php
					$this->html( 'userlangattributes' ) ?>><?php $this->html( 'subtitle' )
						?></div>
					<?php if ( $this->data['undelete'] ) { ?>
						<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
					<?php
}
					?><?php
					if ( $this->data['newtalk'] ) {
						?>
						<div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
					<?php
					}
					?>
					<div id="jump-to-nav" class="mw-jump"><?php
						$this->msg( 'jumpto' )
						?> <a href="#column-one"><?php
							$this->msg( 'jumptonavigation' )
							?></a><?php
						$this->msg( 'comma-separator' )
						?><a href="#searchInput"><?php
							$this->msg( 'jumptosearch' )
							?></a></div>

					<!-- start content -->
<?php
			$this->renderPortals( $this->data['sidebar'] );
			?>
					<?php $this->html( 'bodytext' ) ?>
					<?php
					if ( $this->data['catlinks'] ) {
						$this->html( 'catlinks' );
					}
					?>
					<!-- end content -->
					<?php
					if ( $this->data['dataAfterContent'] ) {
						$this->html( 'dataAfterContent'
						);
					}
					?>
					<div class="visualClear"></div>
				</div>
			</div>
		</div>
		<div id="column-one"<?php $this->html( 'userlangattributes' ) ?>>
			<h2><?php $this->msg( 'navigation-heading' ) ?></h2>
			<?php $this->cactions(); ?>
			<div class="portlet" id="p-personal" role="navigation">
				<h3><?php $this->msg( 'personaltools' ) ?></h3>

				<div class="pBody">
					<ul<?php $this->html( 'userlangattributes' ) ?>>
						<?php foreach ( $this->getPersonalTools() as $key => $item ) { ?>
							<?php echo $this->makeListItem( $key, $item ); ?>

						<?php
}
						?>
					</ul>
				</div>
			</div>
			<div class="portlet" id="p-logo" role="banner">
				<?php
				echo Html::element( 'a', array(
						'href' => $this->data['nav_urls']['mainpage']['href'],
						'class' => 'mw-wiki-logo',
						)
						+ Linker::tooltipAndAccesskeyAttribs( 'p-logo' )
				); ?>

			</div>
			
		</div><!-- end of the left (by default at least) column -->

		<div class="visualClear"></div>
		<?php

		$validFooterIcons = $this->getFooterIcons( "icononly" );
		$validFooterLinks = $this->getFooterLinks( "flat" ); // Additional footer links

		if ( count( $validFooterIcons ) + count( $validFooterLinks ) > 0 ) {
			?>
			<div id="footer" role="contentinfo"<?php $this->html( 'userlangattributes' ) ?>>
			<?php
			$footerEnd = '</div>';
		} else {
			$footerEnd = '';
		}

		foreach ( $validFooterIcons as $blockName => $footerIcons ) {
			?>
			<div id="f-<?php echo htmlspecialchars( $blockName ); ?>ico">
				<?php foreach ( $footerIcons as $icon ) { ?>
					<?php echo $this->getSkin()->makeFooterIcon( $icon ); ?>

				<?php
}
				?>
			</div>
		<?php
		}

		if ( count( $validFooterLinks ) > 0 ) {
			?>
			<ul id="f-list">
				<?php
				foreach ( $validFooterLinks as $aLink ) {
					?>
					<li id="<?php echo $aLink ?>"><?php $this->html( $aLink ) ?></li>
				<?php
				}
				?>
			</ul>
		<?php
		}

		echo $footerEnd;
		?>

		</div>
		<?php
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
			$sidebar['SEARCH'] = true;
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
			} 
			 else {
				$this->customBox( $boxName, $this->$boxName() );
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
		?>
		<div id="p-cactions" class="portlet" role="navigation">
			<h3><?php $this->msg( 'views' ) ?></h3>

			<div class="pBody">
				<ul><?php
					foreach ( $this->data['content_actions'] as $key => $tab ) {
						echo '
				' . $this->makeListItem( $key, $tab );
					} ?>

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
	function headBox() {
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>FunLAB &raquo; Résultats de recherche  &raquo;  fil rouge</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="http://funlab.fr/?attachment_id=935" />
		<link rel="pingback" href="http://funlab.fr/xmlrpc.php" />



 <!-- Starting Social Media Sharing Meta Data From Floating Social Media Icon -->

<!-- WP Menubar 5.1: start CSS -->
<link rel="stylesheet" href="http://funlab.fr/wp-content/plugins/menubar-templates/Superfish/ssf-green.css" type="text/css" media="screen" />
<!-- WP Menubar 5.1: end CSS -->


<link rel='stylesheet' id='su-content-shortcodes-css'  href='http://funlab.fr/wp-content/plugins/shortcodes-ultimate/assets/css/content-shortcodes.css?ver=4.9.2' type='text/css' media='all' />
</head>
<body>
	<div id="backgroundImage"></div>
	<div id="backgroundPattern"></div>
	
		
	
	
	<div id="wrapper">

		<div id="contentWrapper">
			
			<div id="header">
							
				<div id="horizontalLogo">
									</div>
				
								<div id="headerSearch">
					<div id="searchWrap">
												<div class="headerSearchBox">
							<div>
								<div id="headerSearchDiv" style="padding-right:0px;">
									<form role="search" method="get" action="http://funlab.fr">
										<input name="s" id="headerSearchField" title="Search Site" value="" onclick="this.value = '';" style="opacity: 0; ">
										<input id="headerSearchSubmit" type="submit" value="">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
									<label class="custom-select">
					<select id="menu-menuaide" class="mobile-menu dropdown-menu"><option value="" class="blank">Aller a&#8230;</option><option class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330 menu-item-depth-0" value="http://funlab.fr/se-connecter/">Connectez-vous</option>
<option class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1332 menu-item-depth-0" value="http://funlab.fr/inscription/">Inscrivez-vous</option>
</select>					</label>
								
				<div id="navWrap">
					<div id="horizontalNavigation">
						<ul id="menu-menuaide-1" class="sf-menu clearfix"><li id="menu-item-1330" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330"><a href="http://funlab.fr/se-connecter/">Connectez-vous</a></li>
<li id="menu-item-1332" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1332"><a title="Pour ajouter des articles, etc." href="http://funlab.fr/inscription/">Inscrivez-vous</a></li>
</ul> 
					<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				
			</div>
			<div class="clear"></div>


<!-- WP Menubar 5.1: end menu MenuDeroulant, template Superfish, CSS ssf-green.css -->

<!-- WP Menubar 5.1: start menu MenuDeroulant, template Superfish, CSS ssf-green.css -->

<?php }

	/*************************************************************************************************/
	function funBox() {
?>
<div class="ssf-green-wrap">
<ul class="ssf-green"><li><a href="http://funlab.fr/" title="Bienvenue sur le site du FunLAB">ACCUEIL</a></li><li><a href="http://funlab.fr/notre-blog/" title="Suivez notre actualité !">BLOG !</a><ul><li><a href="http://funlab.fr/category/actusblog/" >Actus de FunLAB</a></li><li><a href="http://funlab.fr/category/actusext/" >Actus des Fab Labs</a></li></ul></li><li><a href="http://funlab.fr/notion-de-fab-lab/" title="Qu'est-ce q'un Fab Lab ?">Un Fab Lab, C'EST QUOI ?</a><ul><li><a href="http://funlab.fr/notion-de-fab-lab/def-dun-fab-lab/" >Déf. d'un Fab Lab</a></li><li><a href="http://funlab.fr/notion-de-fab-lab/charte-des-fab-labs/" >Charte Fab Lab</a></li></ul></li><li><a href="http://funlab.fr/presentation-2/" title="Les objectifs du FunLAB">MISSIONS</a><ul><li><a href="http://funlab.fr/presentation-2/ambitions-du-funlab/" >Un projet, le FunLAB</a></li><li><a href="http://funlab.fr/presentation-2/presentation/" >Un atelier pour tous</a></li><li><a href="http://funlab.fr/presentation-2/un-lieu-deducation-populaire/" >Un lieu d'éducation</a></li></ul></li><li><a href="http://funlab.fr/nos-ressources/" title="Ce que nous vous apportons">RESSOURCES</a><ul><li><a href="http://funlab.fr/nos-ressources/du-materiel/" >Du matériel</a></li><li><a href="http://funlab.fr/nos-ressources/des-machines/" >Des machines</a></li><li><a href="http://funlab.fr/nos-ressources/" >Des utilisateurs</a></li><li><a href="http://funlab.fr/nos-ressources/des-animateurs/" >Des animateurs</a></li></ul></li><li><a href="http://funlab.fr/nos-actions/" title="Nos actions sur le terrain">ACTIONS</a><ul><li><a href="http://funlab.fr/nos-actions/ateliers/" >Ateliers réguliers</a></li><li><a href="http://funlab.fr/nos-actions/actions/" >Actions</a></li></ul></li><li><a href="http://funlab.fr/forum/" title="Le forum du Funlab">FORUM</a></li><li><a href="http://funlab.fr/funwiki/" title="Le Wiki du FunLab">WIKI</a></li><li><a href="http://funlab.fr/agenda/" title="L'Agenda du FunLab">AGENDA</a></li><li><a href="http://funlab.fr/a-propos/" title="Qui sommes-nous ?">À PROPOS</a><ul><li><a href="http://funlab.fr/a-propos/lequipe/" >L'équipe</a></li><li><a href="http://funlab.fr/a-propos/revue-depresse/" >Revue de presse</a></li><li><a href="http://funlab.fr/a-propos/nos-statuts/" >Nos statuts</a></li><li><a href="http://funlab.fr/a-propos/mentions-legales/" >Mentions légales</a></li></ul></li></ul>
</div>
<div class="ssf-green-after"></div>
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
	function customBox( $bar, $cont ) {
echo 'cstmbox!';
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
