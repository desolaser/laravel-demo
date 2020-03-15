<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Asunto: Cotización N° {{ $cotizacion->id }}</title>
</head>

<body>
    <div>
        <p>
            Empresa: {{ $cotizacion->empresa->nombre }}<br>
            Estimado: {{ $cotizacion->contacto->nombre }}
        </p>

        <p>
            Junto a un cordial saludo, adjuntamos cotización.<br>
            Quedamos atentos a su respuesta y/o comentarios.<br>
            Agradeciendo su preferencia.<br>
            Atte.<br>
            MICROWAVE TECNOLOGÍAS.
        </p>
    </div>
</body>
</html>