<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Telzir</title>
<meta name="description"
	content="The small framework with powerful features">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
<link
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
	crossorigin="anonymous">
<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
	crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous"></script>

<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script>
$(document).ready(function() {
	$('#tempo').mask('00000');
});

function getPlano(){

	let resp = [];
	
	$.ajax({
        url: "<?php echo base_url('/planos/getplanos/');?>",
        data: {
            id: $('#plano option:selected').val()
        },
        type: "GET",
        async: false,
        cache: false,
        dataType: "json"
    }).done(function(resposta) {    
        if(resposta === null) {
        	resp['resposta'] = resposta;
        } else {
        	resp['resposta'] = resposta.tempo;
        }
    }).fail(function(jqXHR, textStatus) {
        resp['error'] = textStatus;
    }).always(function() {});

	return resp;
}

function getTarifa(){

	let resp = [];
	
	$.ajax({
        url: "<?php echo base_url('/tarifas/gettarifas/');?>",
        data: {
            origem: $('#origem option:selected').val(),
            destino: $('#destino option:selected').val()
        },
        type: "GET",
        async: false,
        cache: false,
        dataType: "json"
    }).done(function(resposta) {
        if(resposta === null) {
        	resp['resposta'] = resposta;
        } else {
        	resp['resposta'] = resposta.tarifa;
        }
    }).fail(function(jqXHR, textStatus) {
    console.log(typeof textStatus);
        resp['error'] = textStatus;
    }).always(function() {});
    
    return resp;
}

/* Função Validar */
function validar() {

  let origem = document.getElementById("origem");
  let destino = document.getElementById("destino");
  let tempo = document.getElementById("tempo");
  let plano = document.getElementById("plano");

  if (origem.value == "") {
    alert("Origem não informado ou inválido!");
    origem.focus();
    return false;
  } else if (destino.value == "") {
    alert("Destino não informado ou inválido!");
    destino.focus();
    return false;
  } else if (tempo.value == "") {
    alert("Tempo não informado ou inválido!");
    tempo.focus();
    return false;
  } else if (plano.value == "") {
    alert("Plano não informado ou inválido!");
    plano.focus();
    return false;
  } else {
  	return true;
  }
}

function calcular() {

	/* valida os campos do formulario */
	if (validar() === false) {
		return false;
	}

	/* recebe os valores da tarifa e do plano */
	let plano = getPlano();
	let tarifa = getTarifa();
	let tempo = $('#tempo').val();

	/* valida a resposta ajax */
    if(typeof plano.value !== 'undefined' || typeof tarifa.value !== 'undefined') {
        alert("Ocorreu um erro ao buscar os dados!");
        return false;
    }else if(tarifa.resposta === null) {
    	alert("DDD de origem e destino não cadastrados!");
    	$('#vlFaleMais').val('-');
    	$('#vlOutros').val('-');
    	return false;
    }

	/* faz o calculo dos planos */
	let calc = (parseFloat(tempo) - parseFloat(plano.resposta));
	calc = calc > 0 ? calc : 0;
	$('#vlFaleMais').val((calc * (parseFloat(tarifa.resposta) + (parseFloat(tarifa.resposta) * 0.1))).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
 	$('#vlOutros').val((parseFloat(tempo) * parseFloat(tarifa.resposta)).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
	
}

</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a href="#" class="navbar-brand">FaleMais</a>
			<button type="button" class="navbar-toggler"
				data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="navbar-nav">
					<a href="#" class="nav-item nav-link active">Home</a> <a href="#"
						class="nav-item nav-link">Services</a> <a href="#"
						class="nav-item nav-link">About</a> <a href="#"
						class="nav-item nav-link">Contact</a>
				</div>
				<div class="navbar-nav ms-auto">
					<a href="#" class="nav-item nav-link">Register</a> <a href="#"
						class="nav-item nav-link">Login</a>
				</div>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="p-5 my-4 bg-light rounded-3">
			<h2>Calcular valor da ligação</h2>
			<div class="row g-3">
				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Origem (DDD)</h6>
					<div class="input-group mb-3">
						<select class="form-select" id="origem" name="origem">
							<option></option>
						<?php
    foreach ($tarifas as $row) {
        ?> <option value="<?php echo $row->origem;?>"><?php echo $row->origem;?></option>
							<?php
    }
    ?>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Destino (DDD)</h6>
					<div class="input-group mb-3">
						<select class="form-select" id="destino" name="destino">
							<option></option>
						<?php
    foreach ($tarifas as $row) {
        ?> <option value="<?php echo $row->destino;?>"><?php echo $row->destino;?></option>
							<?php
    }
    ?>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Tempo em minutos</h6>
					<div class="input-group mb-3">
						<input type="number" class="form-control" id="tempo" name="tempo">
					</div>
				</div>

				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Plano FaleMais</h6>
					<div class="input-group mb-3">
						<select class="form-select" id="plano" name="plano">
							<option></option>
						<?php
    foreach ($planos as $row) {
        ?> <option value="<?php echo $row->id;?>"><?php echo $row->nome;?></option>
							<?php
    }
    ?>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Com Plano FaleMais</h6>
					<div class="input-group mb-3">
						<div class="input-group mb-3">
							<input readonly="readonly" type="text" class="form-control"
								id="vlFaleMais" name="vlFaleMais">
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-2">
					<h6>Sem Plano FaleMais</h6>
					<div class="input-group mb-3">
						<div class="input-group mb-3">
							<input readonly="readonly" type="text" class="form-control"
								id="vlOutros" name="vlOutros">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-4 col-xl-2">
					<div class="input-group mb-3">
						<button onclick="calcular();" type="submit"
							class="btn btn-primary mb-3">Calcular</button>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<footer>
			<div class="row">
				<div class="col-md-6">
					<p>Copyright &copy; 2021 Telzir</p>
				</div>
				<div class="col-md-6 text-md-end">
					<a href="#" class="text-dark">Terms of Use</a> <span
						class="text-muted mx-2">|</span> <a href="#" class="text-dark">Privacy
						Policy</a>
				</div>
			</div>
		</footer>
	</div>
</body>
</html>
