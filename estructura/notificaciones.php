			<?php 			
			session_name("ssdpvccmm");
			if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
			$nivel=$_SESSION["pvtacommand_nivelm"];			
			$nonivel=$nivel;
			if($nivel==1){
				$nivel=".";
			}else{
				$nivel="..";
			}
			$nombreuser=$_SESSION["pvtacommand_nombreuser"];// nombre del usuario
			$tipouser=$_SESSION["pvtacommand_tipouser"];//0 vendedor 1 supervisor 2 administrador 3 creador de empresa
			switch ($tipouser) {
				case 0:$tipouser="Vendedor";break;
				case 1:$tipouser="Supervisor";break;
				case 2:$tipouser="Administrador";break;
				case 3:$tipouser="Manager";break;				
				default:$tipouser="";break;
			}
			?>


			<div class="innerpx">
				<button type="button" class="btn btn-navbar hidden-desktop hidden-tablet">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<div class="positionWrapper">
					<span class="line"></span>
					<div class="profile">
						<img src="<?php echo $nivel;?>/theme/images/user3.png" class="avatar" alt="Profile" />
						<span class="info hidden-phone">
							<strong><?php echo $nombreuser;?></strong>
							<em><?php echo $tipouser;?></em>
						</span>
					</div>
					<!--
					<ul class="notif">						
						<li><a href="" class="glyphicons envelope btn" rel="tooltip" data-placement="bottom" data-original-title="1 new email(s)"><i></i><span>1</span></a></li>
					</ul>
					-->
					<ul class="topnav hidden-phone">
						<li>
							
							<a href="#" onclick="cerrarsesion(<?php echo $nonivel;?>);" class="logout glyphicons lock"><i></i><span>Cerrar Sesión</span></a>
						</li>
					</ul>
					
				</div>
			</div>