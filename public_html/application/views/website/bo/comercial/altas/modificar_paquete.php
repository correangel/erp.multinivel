
<!-- MAIN CONTENT -->
<div id="content">

	<section id="widget-grid" class="">
		<!-- START ROW -->
		<div class="row">
			<!-- NEW COL START -->
			<article class="col-sm-12 col-md-12 col-lg-12">
				<!-- Widget ID (each widget will need unique ID)-->

				<!-- widget div-->
				<div>
					<div class="widget-body">

						<form method="POST" enctype="multipart/form-data"
							action="/bo/admin/update_mercancia" class="smart-form">

							<section class="col col-6" style="display: none;">
								<label class="select"> <select id="tipo_merc" required
									name="tipo_merc">
										<option value="4">merc</option>
								</select>
								</label>
							</section>

							<section class="col col-6" style="display: none;">
								<label class="select"> <select id="id_merc" required
									name="id_merc">
										<option value='<?php echo $id_mercancia?>'>merc</option>
								</select>
								</label>
							</section>

							<fieldset>
								<legend>Datos del Paquete de inscripcion</legend>
								<fieldset>

									<section class="col col-12" style="width: 50%">
										<label class="input">Nombre <input type="text" name="nombre"
											id="nombre_pr" value='<?php echo $data_merc[0]->nombre?>'>
										</label>
									</section>

									<section class="col col-12" style="width: 50%">
										RED <label class="select"> <select name="red">
														<? foreach ( $grupos as $key ) {
															if ($data_merc [0]->id_red == $key->id_grupo) { ?>
																<option selected value='<?=$key->id_grupo?>'>
																<?= $key->descripcion." (".$key->red.")"?>
															<? }else{?>
																<option value='<?=$key->id_grupo ?>'>
																<?= $key->descripcion." (".$key->red.")"?>
															<? }?>
														<?}?>
											</select>
										</label>
									</section>
								</fieldset>
								<fieldset>
								<?$i1=0?>
										        <?if ($prods==null) {?>
										        	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="prods">
										        	<div id="<?= $i1=$i1+1?>a">
										<section class="col col-8" style="width: 50%">
											Productos <label class="select"> <select
												class="custom-scroll" name="producto[]">
												                   	<?
																			
foreach ( $producto as $key ) {
																				?>
																			<option value='<? echo $key->id?>'>
												                            	<? echo $key->nombre?>
												                            </option>
																		<?
																			}
																			?>
																				
											                	</select>
											</label>
										</section>

										<section class="col col-4" style="width: 50%">
											<label class="input">Cantidad de productos <input
												type="number" min="1" name="n_productos[]" id="prod_qty">
											</label>
										</section>
																				<div class=" text-center row">

										<a class='txt-color-red' onclick="delete_product(<?=$i1?>)" style='cursor: pointer;'>Eliminar
											producto <i class="fa fa-minus"> </i>
										</a>
									</div>
									</div>
									</div>
											        <?
																		}
																		foreach ( $prods as $key_1 ) {
																			?>
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
										id="prods">
										<div id="<?= $i1=$i1+1?>a">
										<section class="col col-8" style="width: 50%">
											Productos <label class="select"> <select
												class="custom-scroll" name="producto[]">
												                   	<?
																			
foreach ( $producto as $key ) {
																				if ($key_1->id_producto == $key->id) {
																					?>
												                        	<option selected
														value='<? echo $key->id?>'>
												                            	<? echo $key->nombre?> (ACTIVO)
												                            </option>
												                        <?
																				
} else {
																					?>
																			<option value='<? echo $key->id?>'>
												                            	<? echo $key->nombre?>
												                            </option>
																		<?
																				
}
																			}
																			?>
																				
											                	</select>
											</label>
										</section>

										<section class="col col-4" style="width: 50%">
											<label class="input">Cantidad de productos <input
												type="number" min="1" name="n_productos[]" id="prod_qty"
												value='<? echo $key_1->cantidad_producto?>'>
											</label>
										</section>
										<div class=" text-center row">

										<a class='txt-color-red' onclick="delete_product(<?=$i1?>)" style='cursor: pointer;'>Eliminar
											producto <i class="fa fa-minus"> </i>
										</a>
									</div>	
									</div>
									</div>
												<?}?>

												<div id="agregar" class=" text-center row">

										<a onclick="new_product(<?=$i1?>)" style='cursor: pointer;'>Agregar
											producto <i class="fa fa-plus"> </i>
										</a>
									</div>		
										<?$i2=0;?>
												<?if ($servs==null) {?>
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
										id="servs">
										<div id="<?= $i2=$i2+1?>b">
										<section class="col col-8" style="width: 50%">
											Servicios <label class="select"> <select
												class="custom-scroll" name="servicio[]">
												                        <?foreach ($servicio as $key){?>
													                    	
																				<option value='<? echo $key->id?>'>
													                            	<? echo $key->nombre?>
													                            </option>
																		<?}?>
													            </select>
											</label>
										</section>

										<section class="col col-4" style="width: 50%">
											<label class="input">Cantidad de servicios <input
												type="number" min="1" name="n_servicios[]" id="serv_qty">
											</label>
										</section>
												<div  class=" text-center row">
										<a class='txt-color-red' onclick="delete_service(<?=$i2?>)" style='cursor: pointer;'>Eliminar
											servicio <i class="fa fa-minus"> </i>
										</a>
									</div>
									</div>
									</div>
												<?
												
}
												foreach ( $servs as $key_1 ) {
													?>
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
										id="servs">
										<div id="<?= $i2=$i2+1?>b">
										<section class="col col-8" style="width: 50%">
											Servicios <label class="select"> <select
												class="custom-scroll" name="servicio[]">
												                        <?
													
foreach ( $servicio as $key ) {
														if ($key_1->id_servicio == $key->id) {
															?>
														                        <option selected
														value='<? echo $key->id?>'>
														                            <? echo $key->nombre?> (ACTIVO)
														                        </option>
													                        <?
														
} else {
															?>
																				<option value='<? echo $key->id?>'>
													                            	<? echo $key->nombre?>
													                            </option>
																			<?
														
}
													}
													?>
													            </select>
											</label>
										</section>

										<section class="col col-4" style="width: 50%">
											<label class="input">Cantidad de servicios <input
												type="number" min="1" name="n_servicios[]" id="serv_qty"
												value='<? echo $key_1->cantidad_servicio?>'>
											</label>
										</section>
										<div class=" text-center row">

										<a class='txt-color-red' onclick="delete_service(<?=$i2?>)" style='cursor: pointer;'>Eliminar
											servicio <i class="fa fa-minus"> </i>
										</a>
									</div>
									</div>
									</div>
												<?}?>
												
												<div id="agregar1" class=" text-center row">

										<a onclick="new_service(<?=$i1?>)" style='cursor: pointer;'>Agregar
											servicio <i class="fa fa-plus"> </i>
										</a>
									</div>

								</fieldset>

								<div id="moneda">
									<fieldset id="moneda_field">

										<legend>Moneda y país</legend>

										<section class="col col-2" style="width: 50%;">
											<label class="input"> Costo real <input type="text"
												name="real" id="real" value='<? echo $mercancia[0]->real?>'>
											</label>
										</section>

										<section class="col col-2" style="width: 50%;">
											<label class="input">Costo distribuidores <input type="text"
												name="costo" id="costo"
												value='<? echo $mercancia[0]->costo?>'>
											</label>
										</section>

										<section class="col col-2" style="width: 50%;">
											<label class="input">Costo publico <input type="text"
												name="costo_publico" id="costo_publico"
												value='<? echo $mercancia[0]->costo_publico?>'>
											</label>
										</section>

										<section class="col col-2" style="width: 50%;">
											<label class="input"> Tiempo mínimo de entrega <input
												placeholder="En días" type="text" name="entrega"
												id="entrega" value='<? echo $mercancia[0]->entrega?>'>
											</label>
										</section>

										<section class="col col-12" style="width: 50%;">
											País de la mercancía <label class="select"> <select
												id="pais2" required name="pais">
													<? foreach ( $pais as $key ) {
														if ($mercancia [0]->pais == $key->Code) {
															?>
															<option selected value="<?=$key->Code?>">
																<?=$key->Name?>
															</option>
														<?}else{?>
															<option value="<?=$key->Code?>">
																<?=$key->Name?>
															</option>
														<?}?>
													<?}?>
												</select>
											</label>
										</section>

										<section class="col col-3" style="width: 50%;">
											<label class="input"> Puntos comisionables <input
												type="number" min="1" max="" name="puntos_com"
												id="puntos_com"
												value='<? echo $mercancia[0]->puntos_comisionables?>'>
											</label>
										</section>
										<?$i=0?>
										
										

									</fieldset>
								</div>

								<div>
									<section style="padding-left: 15px; width: 100%;"
										class="col col-12">
										Descripcion <label class="textarea"> <textarea
												name="descripcion" rows="3" class="custom-scroll"><?php echo $data_merc[0]->Descripcion?></textarea>
										</label>
									</section>


									<section id="imagenes2" class="col col-12">
										<label class="label"> Imágen actual </label>
															<?php
															
															foreach ( $img as $key ) {
																echo '<div class="no-padding col-xs-12 col-sm-12 col-md-6 col-lg-6"><img style="max-height: 150px;" src="' . $key [0]->url . '"></div>';
															}
															?>
										            </section>

									<section id="imagenes" class="col col-12">
										<label class="label"> Imágen </label>
										<div class="input input-file">
											<span class="button"> <input id="img" name="img[]"
												onchange="this.parentNode.nextSibling.value = this.value"
												type="file" multiple>Buscar
											</span><input id="imagen_mr"
												placeholder="Agregar alguna imágen" type="text">
										</div>
										<small><cite title="Source Title">Para ver el archivo que va a
												cargar, pulse con el puntero en el boton de "Buscar"</cite>
										</small>
									</section>


								</div>
							</fieldset>

							<section class="col col-12 pull-right">
								<button type="submit" class="btn btn-success">Actualizar</button>
							</section>

						</form>
					</div>

				</div>
				<!-- end widget div -->

			</article>
			<!-- END COL -->
		</div>

	</section>
	<!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->

<script type="text/javascript">
var i = <?= $i?>;
// DO NOT REMOVE : GLOBAL FUNCTIONS!

function new_product(i)
{
	i = parseInt(i) + 1;
	$('#prods').append('<div id="'+i+'a">'
		+'<section class="col col-8" style="width: 50%">Productos'
		+'<label class="select">'
		+'<select class="custom-scroll"  name="producto[]">'
		+'<?foreach ($producto as $key){?>'
		+'<option value="<? echo $key->id?>">'
		+'<? echo $key->nombre?></option>'
		+'<?}?>'
		+'</select>'
		+'</label>'
		+'</section>'
		+'<section class="col col-4" style="width: 50%">'
		+'<label class="input">Cantidad de productos'
		+'<input type="number" min="1" name="n_productos[]" id="prod_qty" >'
		+'</label>'
		+'</section>'
		+'<div  class=" text-center row">'
		+'<a class="txt-color-red" onclick="delete_product('+i+')" style="cursor: pointer;">Eliminar producto' 
		+'<i class="fa fa-minus">'
		+'</i>'
		+'</a>'  
		+'</div>'
		+'</div>');
	i = parseInt(i) + 1;
}

function delete_product(id){
$("#"+id+"a").remove();

}

function new_service(i)
{
	i = parseInt(i) + 1;
	$('#servs').append('<div id="'+i+'b">'
		+'<section class="col col-8" style="width: 50%">Servicios'
		+'<label class="select">'
		+'<select class="custom-scroll" name="servicio[]">'
		+'<?foreach ($servicio as $key){?>'
		+'<option value="<?=$key->id?>">'
		+'<?=$key->nombre?></option>'
		+'<?}?>'
		+'</select>'
		+'</label>'
		+'</section>'
		
		+'<section class="col col-4" style="width: 50%">'
		+'<label class="input">Cantidad de servicios'
		+'<input type="number" min="1" name="n_servicios[]" id="serv_qty" >'
		+'</label>'
		+'</section>'
		+'<div  class=" text-center row">'
		+'<a class="txt-color-red" onclick="delete_service('+i+')" style="cursor: pointer;">Eliminar servicio' 
		+'<i class="fa fa-minus">'
		+'</i>'
		+'</a>'  
		+'</div>'
		+'</div>');
	i = parseInt(i) + 1;
}
function delete_service(id){
$("#"+id+"b").remove();
}

function add_impuesto()
{
	var code=	'<div id="'+i+'"><section class="col col-3" id="impuesto">Impuesto'
	+'<label class="select">'
	+'<select name="id_impuesto[]">'
	<?
	
foreach ( $impuesto as $key ) {
		echo "+'<option value=" . $key->id_impuesto . ">" . $key->descripcion . " " . $key->porcentaje . "%" . "</option>'";
	}
	?>
	+'</select>'
	+'</label>'
	+'<a class="txt-color-red" onclick="dell_impuesto('+i+')" style="cursor: pointer;">Eliminar <i class="fa fa-minus"></i></a>'
	+'</section></div>';
	$("#moneda_field").append(code);
	ImpuestosPais();
	i = i + 1
}

function dell_impuesto(id)
{	
	$("#"+id+"").remove();
	
}

function ImpuestosPais(){
	var pa = $("#pais2").val();
	
	$.ajax({
		type: "POST",
		url: "/bo/mercancia/ImpuestaPais",
		data: {pais: pa}
	})
	.done(function( msg )
	{
		$('#impuesto option').each(function() {
		    
		        $(this).remove();
		    
		});
		datos=$.parseJSON(msg);
	      for(var i in datos){
		      var impuestos = $('#impuesto');
		      $('#impuesto select').each(function() {
				  $(this).append('<option value="'+datos[i]['id_impuesto']+'">'+datos[i]['descripcion']+' '+datos[i]['porcentaje']+'</option>');
			    
			});
	    	  
	        
	      }
	});
}
</script>