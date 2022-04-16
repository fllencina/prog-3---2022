<html>
	<head>
		<title>Subir archivos con PHP</title>
	</head>
	<body>
		<form action="index.php" method="post" enctype="multipart/form-data" >
			<input type="file" name="archivos[]" multiple /> 
			<br/>
			<input type="submit" value="Subir" />
		</form>
	</body>
</html>
