	<?php
//		<div id="ex-p-cactions" class="ex-portlet"
	?>
<div id="column-content">
<div class="ssf-green-wrap" role="navigation">

	<?php /*		<h3><?php $this->msg( 'views' ) ?></h3>
*/?>
			<div class="e-pBody">
 
<?php
					foreach ( $this->data['content_actions'] as $key => $tab ) {
if ($key=='move')
	{
		$editcactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='talk')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='nstab-main')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}else if ($key=='nstab-special')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='edit')
	{
		$editcactions[]= '' . $this->makeListItem( $key, $tab );
}else if ($key=='nstab-user')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='history')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='delete')
	{
			$editcactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='protect')
	{
			$editcactions[]= '' . $this->makeListItem( $key,$tab);
}
else if ($key=='unwatch')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='watch')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='purge')
	{
			$editcactions[] = '' . $this->makeListItem( $key, $tab );}
else if ($key=='viewsource')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='nstab-mediawiki')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}
else if ($key=='nstab-blog')
	{
		$viewscactions[]= '' . $this->makeListItem( $key, $tab );
}

else { echo "$key:<br />";
$viewscactions[]= '' . $this->makeListItem( $key, $tab );	

//echo 'inconnu:' . $this->makeListItem( $key, $tab );
//echo 'inconnu:'.$key );

}

}

?>

   
 <ul class="ssf-green">
<li>
<a title="Ce que nous vous apportons" href="http://funlab.fr/nos-ressources/">edit</a>
  <ul>
<?php

$i=0;
foreach ( $editcactions as $key => $tab ) {

echo  $tab;
}
?>
</ul></li>
<li>   <a title="Ce que nous vous apportons" href="http://funlab.fr/nos-ressources/">voir</a>
<ul>
<?php
$i=0;
foreach ( $viewscactions as $key => $tab ) {

echo $tab.'<li>'.$i++.'</li>';
}
?></li>
</ul>

</li>
</ul>


