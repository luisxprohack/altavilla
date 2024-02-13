<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    
</head>
<body>
    
    <div id='contenido'>
        <p id="textFinal" onclick="ajaxForm()">Validacion</p>
        <input type="text" name="dni" id="dni" onkeyup="ajaxForm()">
        <button type="button" onclick="ajaxForm()">Modificar</button>
    </div>

    <div>
        <input type="text" id="cantidad">
        <button onclick="listaOcupaciones()">Listar Ocupaciones</button>
        <div id="listado"></div>
    </div>

    <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
 
    <script>

        function listaOcupaciones(){
            let cant = $('#cantidad').val()
            $.ajax({
                url: "{{ url('ocupaciones') }}",
                data: {
                    cantidad : cant
                },
                success: function(data){
                    $('#listado').html(data)
                }
            })
        }

        function ajaxForm(){
            let dni = $('#dni').val()
            $.ajax({
                url: "{{ url('ajax') }}",
                data: {
                    dni    
                },
                success: function( data ) {
                    if(data.success == true){
                        $('#textFinal').css('color','blue')
                    }else{
                        $('#textFinal').css('color','red')
                    }

                    $('#textFinal').html(data.mensaje)
                }
            });
        }
    </script>

</body>
</html>