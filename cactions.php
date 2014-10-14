	<?php	?>
		<div id="ex-p-cactions" class="ex-portlet" role="navigation">
			<h3><?php $this->msg( 'views' ) ?></h3>

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
			$editcactions[] = '' . $this->makeListItem( $key, $tab );
}
else { echo "Cactions keys inconnu L323 funtemplate.php: $key";	

//echo 'inconnu:' . $this->makeListItem( $key, $tab );
//echo 'inconnu:'.$key );

}

}

?>
<div class="ssf-green-wrap">
   
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

</div>
