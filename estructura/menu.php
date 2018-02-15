					<?php					
					session_name("ssdpvccmm");
					if (!isset($_SESSION["pvtacommand_nivelm_sub"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}
					$nivel=$_SESSION["pvtacommand_nivelm"];	
					if($nivel==1){
						$nivel=".";
					}else{
						$nivel="..";
					}
					$menuactivo=$_SESSION["pvtacommand_nivelm_sub"];
					
					/*
					1 empresa
					2 sucursales
					3 agrupadores
					4 usuarios
					*/
					$tipouser=$_SESSION["pvtacommand_tipouser"];//0 vendedor 1 supervisor 2 administrador 3 creador de empresa
					
					?>

					<div class="span2 col main-left hide hidden-phone menu-large">
						<div class="rrow scroll-y-left">
							<div class="iScrollWrapper">
								<ul>
									<li class="glyphicons home currentScroll <?php if($menuactivo==1){ echo ' active';}?>"><a href="<?php echo $nivel;?>/principal.php"><i></i><span>Inicio</span></a></li>
									<?php 
									if($tipouser==1 || $tipouser==2){// supervisor y administrador
									?>
									<li class="hasSubmenu2">
										<a data-toggle="collapse" class="glyphicons bookmark" href="#menu_catalogos"><i></i><span>Catalogos</span></a>
										<ul class="collapse" id="menu_catalogos">
											
											<li class="<?php if($menuactivo==18){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/usuarios.php" class="glyphicons user"><i></i><span>Usuarios</span></a></li>
											<li class="<?php if($menuactivo==3){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/productos.php" class="glyphicons tags"><i></i><span>Productos</span></a></li>
											<li class="<?php if($menuactivo==21){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/proveedores.php" class="glyphicons user"><i></i><span>Proveedores</span></a></li>
											<li class="<?php if($menuactivo==22){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/tipoprod.php" class="glyphicons user"><i></i><span>Tipo de Producto</span></a></li>

										</ul>
									</li>	
									<?php
									}
									if($tipouser==0){ // vendedor 
									?>
									<li class="glyphicons shopping_cart <?php if($menuactivo==4){ echo " active";}?>"><a href="<?php echo $nivel;?>/ventas/ventas.php"><i></i><span>Ventas</span></a></li>
									<li class="<?php if($menuactivo==19){ echo " active";}?>"><a href="<?php echo $nivel;?>/movdevoluciones/moventradas.php" class="glyphicons coins"><i></i><span>Devoluciones</span></a></li>

									<?php
									}

									if($tipouser==1){ // supervisor
									?>
									<li class="glyphicons shopping_cart <?php if($menuactivo==4){ echo " active";}?>"><a href="<?php echo $nivel;?>/ventas/ventas.php"><i></i><span>Ventas</span></a></li>
									<?php
									}




									if($tipouser==1 || $tipouser==2){ // supervisor y admin
									?>

									<li class="hasSubmenu2">
										<a data-toggle="collapse" class="glyphicons table" href="#menu_movimientos"><i></i><span>Movimientos</span></a>
										<ul class="collapse" id="menu_movimientos">
											<li class="<?php if($menuactivo==5){ echo " active";}?>"><a href="<?php echo $nivel;?>/moventradas/moventradas.php" class="glyphicons airplane"><i></i><span>Entradas</span></a></li>
											<li class="<?php if($menuactivo==6){ echo " active";}?>"><a href="<?php echo $nivel;?>/movtraspasos/traspasos.php" class="glyphicons home"><i></i><span>Traspasos</span></a></li>
											<li class="<?php if($menuactivo==7){ echo " active";}?>"><a href="<?php echo $nivel;?>/movbajas/bajas.php" class="glyphicons magic"><i></i><span>Bajas</span></a></li>
											<li class="<?php if($menuactivo==8){ echo " active";}?>"><a href="<?php echo $nivel;?>/movinventarios/inventarios.php" class="glyphicons user"><i></i><span>Inventarios</span></a></li>
											<li class="<?php if($menuactivo==19){ echo " active";}?>"><a href="<?php echo $nivel;?>/movdevoluciones/moventradas.php" class="glyphicons coins"><i></i><span>Devoluciones</span></a></li>
										</ul>
									</li>	
									<?php
									}
									
									?>
									<li class="hasSubmenu2">
										<a data-toggle="collapse" class="glyphicons charts" href="#menu_reportes"><i></i><span>Reportes</span></a>
										<ul class="collapse" id="menu_reportes">
											<li class="<?php if($menuactivo==9){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repentrada.php" class="glyphicons star"><i></i><span>Entradas</span></a></li>

											<li class="<?php if($menuactivo==22){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repentrada2.php" class="glyphicons star"><i></i><span>Entradas para Sucursales</span></a></li>

											<li class="<?php if($menuactivo==10){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repsalidas.php" class="glyphicons keynote"><i></i><span>Ventas</span></a></li>

											<li class="<?php if($menuactivo==11){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/reptraspasos.php" class="glyphicons clock"><i></i><span>Traspasos</span></a></li>

											<li class="<?php if($menuactivo==12){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repbajas.php" class="glyphicons magic"><i></i><span>Bajas</span></a></li>
											
											<li class="<?php if($menuactivo==13){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repinventario.php" class="glyphicons signal"><i></i><span>Inventarios</span></a></li>

											<li class="<?php if($menuactivo==14){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repproductos.php" class="glyphicons display"><i></i><span>Productos</span></a></li>
											<li class="<?php if($menuactivo==23){ echo " active";}?>"><a href="<?php echo $nivel;?>/reportes/repbitacora.php" class="glyphicons warning_sign"><i></i><span>Bitacora</span></a></li>
										</ul>
									</li>
									<?php
									
									if($tipouser==3){ // supervisor y admin
									?>
									<li class="hasSubmenu2">
										<a data-toggle="collapse" class="glyphicons cogwheels" href="#menu_configuraciones"><i></i><span>Configuraciones</span></a>
										<ul class="collapse" id="menu_configuraciones">
											
											<li class="<?php if($menuactivo==15){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/empresa.php" class="glyphicons airplane"><i></i><span>Empresa</span></a></li>
											<li class="<?php if($menuactivo==16){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/sucursales.php" class="glyphicons home"><i></i><span>Sucursales</span></a></li>
											<li class="<?php if($menuactivo==17){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/agrupadores.php" class="glyphicons magic"><i></i><span>Agrupadores</span></a></li>

											<li class="<?php if($menuactivo==18){ echo " active";}?>"><a href="<?php echo $nivel;?>/catalogos/usuarios.php" class="glyphicons user"><i></i><span>Usuarios</span></a></li>	
											<li class="<?php if($menuactivo==20){ echo " active";}?>"><a href="<?php echo $nivel;?>/utilerias/utilidad.php" class="glyphicons warning_sign"><i></i><span>Ajuste Utilidad</span></a></li>											
										</ul>
									</li>
									<?php
									}
									?>
								</ul>
							</div>
							<span class="navarrow hide">
								<span class="glyphicons circle_arrow_down"><i></i></span>
							</span>
						</div>
					</div>