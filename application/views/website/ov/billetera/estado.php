
			<!-- MAIN CONTENT -->
			<div id="content">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<h1 class="page-title txt-color-blueDark">
							<span>
							<a class="backHome" href="/bo"><i class="fa fa-home"></i> Menu</a>
							<a href="/ov/billetera2/index_estado"> > Estado de cuenta</a>
							 > Estado</span>
							
						</h1>
					</div>
				</div>
				<!-- row -->
				<div class="row">
				</div>
				<!-- end row -->

				<!-- row -->
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="well">

							<section id="widget-grid" class="">
							
								<!-- row -->
								<div class="row">
							
									<!-- NEW WIDGET START -->
									<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

										<!-- Widget ID (each widget will need unique ID)-->
										<div class="jarviswidget jarviswidget-color-purity" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="true">
											<!-- widget options:
											usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
							
											data-widget-colorbutton="false"
											data-widget-editbutton="false"
											data-widget-togglebutton="false"
											data-widget-deletebutton="false"
											data-widget-fullscreenbutton="false"
											data-widget-custombutton="false"
											data-widget-collapsed="true"
											data-widget-sortable="false"
							
											-->
																							<!-- widget content -->
												<div class="widget-body">
													<div id="myTabContent1" class="tab-content padding-10">
													<h1 class="text-center"></h1>
													
													<div class="table-responsive">
													<table class="table">
													<thead>
														<tr>
															<th> <i class="fa fa-sitemap"></i> Red</th>
															<th> <i class="fa fa-money"></i> Comision</th>
														</tr>
													</thead>
													<tbody>
												<?php 
													$total = 0; 
													$i = 0;
													
													$total_transact = 0;
													
													foreach ($ganancias as $gred){
														if($gred[0]->valor!=0){
														echo '<tr class="success" >
																<td colspan="2">'.$gred[0]->nombre.'</td>
															</tr>'; 

														echo '<tr class="success">
															<td>Comisiones Directas</td>
																<td>$ '.number_format($comisiones_directos[$i][0]->valor,2).'</td>
															</tr>'; 
														
														echo '<tr class="success">
															<td>Comisiones Indirectas</td>
																<td>$ '.number_format($gred[0]->valor - $comisiones_directos[$i][0]->valor,2).'</td>
															</tr>'; 

														if($gred[0]->valor){
														echo '<tr class="warning">
																<td>Total</td>
																<td>$ '.number_format($gred[0]->valor,2).'</td>
															</tr>';
														$total += $gred[0]->valor;
														}else {
															echo '<tr class="warning">
																<td> Total </td>
																<td>$ 0</td>
															</tr>';
														}
														$i++;
													}
													}

													?>  
													<tr class="success">
														<td><h4><b>TOTAL</b></h4></td>
														<td>
															<div class="col-md-3">
																<h4><b>$ <?php echo number_format($total,2);?></b></h4>
															</div>
															<div class="col-md-1">
																<a title='Ver detalles' style='cursor: pointer;' class='txt-color-green' 
																		onclick='ventas(<?=$id?>,"<?=$fecha?>");'>
																	<i class='fa fa-eye fa-3x'></i>
																</a>
															</div>	
														</td>
													</tr>
													
													<?php if ($transaction) { ?>	
														<tr class="warning">
															<td colspan="2"><b>TRANSACCIONES EMPRESA</b></td>
														</tr>
													<?php if ($transaction['add']) {
															$total_transact+=$transaction['add'];
														?>
														<tr class="warning">
															<td ><b>Total Agregado</b></td>
															<td ><b style="color: green">$ <?php echo number_format($transaction['add'],2);?></b></td>
														</tr>
													<?php } 
													if ($transaction['sub']) {
														$total_transact-=$transaction['sub'];
														?>
														<tr class="warning" >
															<td ><b>Total Quitado</b></td>
															<td ><b style="color: red">$ <?php echo number_format($transaction['sub'],2);?></b></td>
														</tr>
													<?php } ?>
														<tr class="warning">
															<td ><b>TOTAL:</b></td>
															<td ><h4><b >$ <?php echo number_format($total_transact,2);?></b></h4></td>
														</tr>
													<?php	} ?>
													
													</tbody>
													</table>
														
													</div>

													
															<table id="dt_basic" class="table table-striped table-bordered table-hover">
																
																	<?php 
																	$retenciones_total=0;
																	foreach ($retenciones as $retencion) {?>
																	<tr class="danger">
																		<td><b>Retencion por <?php echo $retencion['descripcion']; ?></b></b></td>
																		<td></td>
																		<td>$ <?php 
																		$retenciones_total+=$retencion['valor'];
																		echo number_format($retencion['valor'],2); ?></td>
																	</tr>
																	<?php $total;
																	} ?>
																
																	<tr class="danger">
																		<td><b>Cobros Pendientes</b></td>
																		<td></td>
																		<td>$ <?php 
																		if($cobroPendientes==null)
																			echo "0";
																		else
																			echo number_format($cobroPendientes,2);
																		?></td> 
																	</tr>
																
																	<?php foreach ($cobro as $cobros){
																	?>
																	<tr class="danger">
																		<td><b>Cobros Pagos</b></td>
																		<td></td>
																		<td>$ 
																		<?php 
																		if($cobros->monto==null){
																		  echo '0';
																		  $cobro=0;
																		}
																		else {
																		  echo number_format($cobros->monto,2);
																		  $cobro=$cobros->monto;
																		}
																		?></td>
																	</tr>
																	<?php 
																	}?>
																	<tr class="info">
																		<td><h4><b>Saldo Neto</b></h4>
																		<td></td>
																		<td><h4><b>$ <?php echo number_format(($total-($cobro+$retenciones_total+$cobroPendientes)+($total_transact)),2); ?></b></h4></td>
																	</tr>
																</table>
														
													</div>
												
												</div>
							

											<!-- end widget div -->
										</div>
										<!-- end widget -->
							
									</article>
								</div>
							</section>
						<!-- end widget grid -->
						</div>
					</div>
				<!-- row -->
				</div>
				<div class="row">
			        <div class="col-sm-12">
			            <br />
			            <br />
			        </div>
		        </div>
				<!-- end row -->

			</div>
			<!-- END MAIN CONTENT -->

		<!-- PAGE RELATED PLUGIN(S) 
		<!-- Morris Chart Dependencies -->
		<script type="text/javascript">

			function ver(id){
				$.ajax({
					type: "POST",
					url: "/ov/billetera2/historial_transaccion",
					data: {id: id}
				})
				.done(function( msg )
				{					
					bootbox.dialog({
						message: msg,
						title: 'Historial de Transacciones',
						buttons: {
							danger: {
								label: "Cerrar",
								className: "btn-danger",
								callback: function() {

									}
						}
					}})//fin done ajax
				});//Fin callback bootbox
			}

			function ventas(id,fecha){
				$.ajax({
					type: "POST",
					url: "/ov/billetera2/ventas_comision",
					data: {id: id, fecha: fecha}
				})
				.done(function( msg )
				{					
					bootbox.dialog({
						message: msg,
						title: 'Detalles de la Comisiones',
						buttons: {
							danger: {
								label: "Cerrar",
								className: "btn-danger",
								callback: function() {

									}
						}
					}})//fin done ajax
				});//Fin callback bootbox
			}

		</script>
		<script src="/template/js/plugin/morris/raphael.min.js"></script>
		<script src="/template/js/plugin/morris/morris.min.js"></script>

		<script src="/template/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="/template/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="/template/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="/template/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script src="/template/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
	