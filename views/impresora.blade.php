<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copisteria</title>
</head>

<body>
    <p> Hojas impresas: </p>
    <p> Introduce la impresora y el texto a imprimir </p>
    <div style='display: flex; flex-direction: column;'><br>
        <form action='/trabajo' method='get'>
            <label>Impresora:</label>
            <select name='opciones' id='opc'>
            @foreach($impresoras as $impresora)
                <option value='{{ $impresora->id }}'>Impresora {{ $loop->iteration }}</option>
            @endforeach
            </select><br>
            <br><input type='text' cols='60' rows='10' style='width:200px; height:50px;' name='Text' id='Text1'
                value=''><br>
            <br>
            <input type='submit' name='enviar' value='Enviar a impresora'>
        </form>
    </div>

    @foreach($impresorasConMensajes as $impresorasConMensaje)
<div style='display: flex; flex-direction: row;'>
    <div style='display: flex; flex-direction: column;'>
        <a href='/imprimir/{{ $impresorasConMensaje->impresora->id }}'><img style='margin: 50px;' width='80px;'
                src="{{ asset('images/impresora.jpg') }}"></img></a>
        <div style='display: flex; flex-direction: row;'>
            <div style='background-color:black; color:grey;width:50px;height:50px;margin:5px'>
                {{ $impresorasConMensaje->impresora->black }}
            </div>
            <div class='tinta' style='background-color:yellow; color:grey;width:50px;height:50px;margin:5px'>
                {{ $impresorasConMensaje->impresora->yellow }}
            </div>
            <div class='tinta' style='background-color:cyan; color:grey;width:50px;height:50px;margin:5px'>
                {{ $impresorasConMensaje->impresora->cyan }}
            </div>
            <div class='tinta' style='background-color:magenta; color:grey;width:50px;height:50px;margin:5px'>
                {{ $impresorasConMensaje->impresora->magenta }}
            </div>
        </div>
        
            @foreach($impresorasConMensaje->mensajes as $mensaje)
            <p style='margin-left: 20px'>
                {{ $mensaje }}
            </p>
            @endforeach
       
        <br>
    </div>
</div>
@endforeach

</body>

</html>
