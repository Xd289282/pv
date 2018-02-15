<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

$btnventa=$_SESSION["pvtacommand_btnventa"];//0 esta seleccionado boton cantidad 1 boton codigo
?>


							<div class="widget widget-2 primary widget-body-white">
								<div class="widget-head">
									<h4 class="heading glyphicons ok"><i></i></h4>
								</div>
								<div class="widget-body" align="center">
									<table width="100%" border="0">
										<tr>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,7);"><i class="fa fa-user"><div class="numberCircle">7</div></i></a>
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,8);"><i class="fa fa-user"><div class="numberCircle">8</div></i></a>
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,9);"><i class="fa fa-user"><div class="numberCircle">9</div></i></a>
											</td>
											<td rowspan="2">
												<button class="btn btn-primary" onclick="fenter();" style="height:100%;"><i class="fa fa-user">Enter..</i></button>
											</td>
											
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,4);"><i class="fa fa-user"><div class="numberCircle">4</div></i></a>												
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,5);"><i class="fa fa-user"><div class="numberCircle">5</div></i></a>
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,6);"><i class="fa fa-user"><div class="numberCircle">6</div></i></a>
											</td>
											
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,1);"><i class="fa fa-user"><div class="numberCircle">1</div></i></a>
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,2);"><i class="fa fa-user"><div class="numberCircle">2</div></i></a>
											</td>
											<td>
												<a href="#" class="btn btn-primary" onclick="calc(<?php echo $btnventa;?>,3);"><i class="fa fa-user"><div class="numberCircle">3</div></i></a>
											</td>
											<td rowspan="2">
												<button class="btn btn-primary" onclick="calcb(<?php echo $btnventa;?>);" style="height:100%;"><i class="fa fa-user">Borrar</i></button>

												
											</td>
											
										</tr>


										<tr>

											<td colspan="3">
												<button class="btn btn-primary btn-lg btn-block" onclick="calc(<?php echo $btnventa;?>,0);"><i class="fa fa-user"><div class="numberCircle">0</div></i></button>

											</td>
											
										</tr>

										
									</table>									
									
								</div>
							</div>