<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Datos de Usuario</title>
</head>
<body>
	<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr>
		<td style="background-color: ; text-align: left; padding: 0; display: inline;">
				<img width="20%" style="margin: 1.5% 3%" src="https://i.postimg.cc/k5RQgzJT/logo.png">
				<img width="60%" style="margin: 1.5% 3%" src="https://i.postimg.cc/gj4D9hsR/barraup.png">
		</td>
	</tr>
	<tr>
		<td style="background-color: ">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif; position: relative; display: inline-block; background-image: url(https://i.postimg.cc/Dw9ht488/lavaloza-1.png); background-repeat: no-repeat; background-position: center right;">
				{{-- <img src="https://i.postimg.cc/Dw9ht488/lavaloza-1.png" width="100" /> --}}
				<h2 style="color: #000; margin: 0 0 7px">Estimado Cliente</h2>
				<p style="margin: 2px; font-size: 15px">
					Te damos la más cordian bienvenida a nuestro WMC de portal de clientes:<br><br>
					Usuario: <b style="color: #00adef;">{{ $user->name }}</b><br>
					Contraseña: <b style="color: #00adef;">123123</b><br><br>
					<b>Notas Importantes al ingresar al WMC:</b></p>
				<ul style="font-size: 15px;  margin: 10px 0">
					<li>Cambiar tu contraseña.</li>
					<li>Ingresar un email valido.</li>
				</ul> <br>
				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="http://appbennetts.com/wmc/">Ir a la página</a>
				</div>
				<p style="color: #00adef; font-size: 16px; text-align: center;margin: 30px 0 0">Atentamente: Key-Bennetts</p>
			</div>
		</td>
	</tr>
	<tr>
		<td style="background-color: ; text-align: left; padding: 0; display: inline;">
				<img width="100%" style="margin: 1.5% 3%" src="https://i.postimg.cc/gj4D9hsR/barraup.png">
		</td>
	</tr>
	</table>
</body>
</html>