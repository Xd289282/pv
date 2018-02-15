<?php
	date_default_timezone_set("America/Mexico_City");	
	
	//mysql_connect("localhost","commandp_pventaw","pventaweb159753") or die(mysql_error());
	//mysql_select_db("commandp_pventa") or die(mysql_error());


	
	
	//mysql_connect("localhost","root","cuboye1081") or die(mysql_error());	
	//mysql_select_db("pventa") or die(mysql_error());

	//mysql_connect("localhost","root","cuboye1081") or die(mysql_error());	
	//mysql_select_db("pventa") or die(mysql_error());

	//$cadbd=mysqli_select_db("localhost","root","cuboye1081") or die(mysql_error());	
	//mysqli_select_db($cadbd,"pventa");


	$link = mysqli_connect("localhost", "root", "");
	mysqli_select_db($link, "pventa");
	$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente

	//$link = mysqli_connect("localhost", "pventaweb159753", "");
	//mysqli_select_db($link, "commandp_pventa");
	//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
?>
