@component('mail::message')
![alt text][header] ![alt text][header2]


[logo]: https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 2"
[header]: https://i.postimg.cc/kM65TPJW/logo.png
[header2]: https://i.postimg.cc/gj4D9hsR/barraup.png

# Tus Credenciales para acceder a {{ config('app.name') }}
Utiliza estas credenciales para acceder al sistema

@component('mail::table')
| Nombre de Usuario | Contraseña |
|:-------------------|:------------|
| {{ $user->username }} | {{ $password }}
@endcomponent


@component('mail::button', ['url' => url('login')])
Iniciar Sesion
@endcomponent
Nota: Te sugerimos Cambiar tu contraseña una vez ingreses al sistema, en la parte superior derecha dando click en tu nombre y despues en la opcion Mi Perfil
Gracias,<br>
{{ config('app.name') }}

Nota: En caso de estar no estar seguro haber pedido este correo, re-envia este correo a daniel.trejo@bennetts.com.mx ó rosario.sanjuan@bennetts.com.mxy explicanos el problema.


![alt text][header2]
@endcomponent