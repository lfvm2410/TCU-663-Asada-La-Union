<?php include COMPONENTS.'header.php';?>
	<script src="<?php print URL;?>public/js/index.js" type="text/javascript"></script>
</head>
<body>
<?php include COMPONENTS.'encabezadoIndex.php';?>
<style type="text/css">
	h3, p{
		color:#00ABFF !important;
	}
</style>
	<div class="container">
		<br>
		<div class="col-md-12">
			<div id="carousel-1" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-1" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-1" data-slide-to="1"></li>
					<li data-target="#carousel-1" data-slide-to="2"></li>
					<li data-target="#carousel-1" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div id="item1" class="item active"></div>
					<div id="item2" class="item"></div>
					<div id="item3" class="item"></div>
					<div id="item4" class="item"></div>
				</div>
				<a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
		</div>
	</div>
<?php include COMPONENTS.'pie.php';?>
</body>
</html>