<?php
require_once "funlabTemplate.php";
class funlabTemplateAPI
{
/*
$msg=array;
$data=array();
$html=array();
*/
function pmwcontent($msg,$html,$data){
$this->msg=$msg;
$this->html=$html;
$this->data=$data;
?>
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

<!-- start p-personaltools -->
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
<!-- end p-personaltools -->

			</div>	
<h1 id="firstHeading" class="firstHeading" lang="<?php
				$this->data['pageLanguage'] =
					$this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
				$this->text( 'pageLanguage' );
				?>"><span dir="auto"><?php $this->html( 'title' ) ?></span></h1>
<div id="toolbar"></div>
					<!-- start content -->
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

				</div>
	<?php	funlabTemplateAPI::foot($msg,$html,$data);?>
					</div>

			
		</div>
</div>
<?php
}

function foot($msg,$html,$data){
$this->msg=$msg;
$this->html=$html;
$this->data=$data;
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
echo "<div>";
		foreach ( $validFooterIcons as $blockName => $footerIcons ) {
			?>
			<span id="f-<?php echo htmlspecialchars( $blockName ); ?>ico">
				<?php foreach ( $footerIcons as $icon ) { ?>
					<?php {echo $this->getSkin()->makeFooterIcon( $icon ); }?>

				<?php
}echo "</span>";
			
		}
	?>
</div>
		<?php
		if ( count( $validFooterLinks ) > 0 ) {
			?>
<br /><div>
			<ul id="f-list">
				<?php
				foreach ( $validFooterLinks as $aLink ) {
					?>
					<li id="<?php echo $aLink ?>"><?php $this->html( $aLink ) ?></li>
				<?php
				}
				?>
			</ul>
</div>
	</div></div>
	<?php
		}

		echo $footerEnd;
		}


function banner($msg,$html,$data){
$this->msg=$msg;
$this->html=$html;
$this->data=$data;
 ?><div id="column-one"<?php $this->html( 'userlangattributes' ) ?>>
			<h2><?php $this->msg( 'navigation-heading' ) ?></h2>

			
					<?php }	


}
