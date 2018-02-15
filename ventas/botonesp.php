<?php
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
?>
<div class="lbl glyphicons cogwheel"><i></i>Cantidad:</div>
								<div>			
									<div class="input-append">
										<div class="input-append" >
											<input type="text" name="from" id="dateRangeFrom"   style="width:80px;height:30px;" />
										</div>
									</div>
								</div>
								<div class="lbl glyphicons cogwheel"><i></i>Codigo:</div>
								<div>											
									<div class="input-append">
										<input type="text" name="from" id="dateRangeFrom"   style="width:200px;height:30px;" />
									</div>
									<div class="input-append">
										<button class="btn" style="height:37px;" id="lupa22">
											<p><span class="glyphicons search" ><i></i></span></p>
										</button>
									</div>
								</div>
								<div class="clearfix"></div>