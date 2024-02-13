@extends('layouts.app')

@section('title', 'Escritorio')

@section('content')

    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="info-box" style="background-color: #FFA500;">
            <div class="info-box-content">
                <h4 class="box-title" style="color: black;">Ingresos Mensuales</h4>
                <h3 class="box-value" style="color: black;"> S/.12,345.67</h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="info-box" style="background-color: #FFA500;">
            <div class="info-box-content">
                <h4 class="box-title" style="color: black;">Clientes Actuales</h4>
                <h3 class="box-value" style="color: black;"> 12,345</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="info-box" style="background-color: #FFA500;">
            <div class="info-box-content">
                <h4 class="box-title" style="color: black;">Clientes Activos</h4>
                <h3 class="box-value" style="color: black;">12%</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="info-box" style="background-color: #FFA500;">
            <div class="info-box-content">
                <h4 class="box-title" style="color: black;">Tasa de Cancelación</h4>
                <h3 class="box-value" style="color: black;"> 2%</h3>
            </div>
        </div>
    </div>

    <div class="row col-12">
        <!-- Card de tendencias -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color: black;">Tendencias</h5>
                    <canvas id="tendenciasChart" width="400" height="200"></canvas>
                    <a href="#" class="btn btn-primary" style="background-color: #FFA500; border: none;">Ver más</a>
                </div>
            </div>
        </div>

        <!-- Card de ventas -->
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color: black;">Ventas</h5>
                    <canvas id="ventasChart" width="400" height="200"></canvas>
                    <p class="card-text" style="color: black;">Resumen de las ventas recientes.</p>
                    <a href="#" class="btn btn-primary" style="background-color: #FFA500; border: none;">Ver más</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color: black;">Transacciones</h5>
                    <p class="card-text" style="color: black;">Información sobre transacciones financieras.</p>
                    <ul class="list-group">
                        <li class="list-group-item" style="background-color: #FF9800; color: black;">Transacción 1 - En proceso</li>
                        <li class="list-group-item" style="background-color: #ff9900; color: black;">Transacción 2 - En proceso</li>
                        <li class="list-group-item" style="background-color: #000000; color: white;">Transacción 3 - Cancelada</li>
                        <li class="list-group-item" style="background-color: #FFD700; color: black;">Transacción 4 - Pendiente</li>
                        <li class="list-group-item" style="background-color: #FF9800; color: black;">Transacción 5 - En proceso</li>
                        <li class="list-group-item" style="background-color: #FF9800; color: black;">Transacción 6 - En proceso</li>
                        <li class="list-group-item" style="background-color: #FF9800; color: black;">Transacción 7 - En proceso</li>
                    </ul>
                    <a href="#" class="btn btn-primary" style="background-color: #FFA500; border: none;">Ver más</a>
                </div>
            </div>         
        </div>
    </div>


    <script>
        var infoBoxes = document.querySelectorAll('.info-box');

        infoBoxes.forEach(function(box) {
            box.addEventListener('mouseover', function() {
                box.style.backgroundColor = '#0A0A0A';
                box.querySelectorAll('.box-title, .box-value').forEach(function(element) {
                    element.style.color = '#ffffff';
                });
            });

            box.addEventListener('mouseout', function() {
                box.style.backgroundColor = '#FFA500';
                box.querySelectorAll('.box-title, .box-value').forEach(function(element) {
                    element.style.color = '#0A0A0A';
                });
            });
        });


        // Datos de ejemplo para simular tendencias
        var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'tendencia',
                backgroundColor: [
                    '#000000', // Negro
                    '#0a0a0a', // Gris oscuro
                    '#ff9800', // Naranja claro
                    '#ff9c00', // Naranja
                    '#ffa500' // Amarillo
                ],
                borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                borderWidth: 0,
                data: [12000, 14000, 8000, 8100, 5600]
            }]
        };

        // Configuración del gráfico
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Crear el gráfico de barras
        var ctx = document.getElementById('tendenciasChart').getContext('2d');
        var tendenciasChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

        // Datos de ejemplo para simular ventas por categoría
        var data = {
            labels: ['item1', 'item2', 'item3', 'item4'],
            datasets: [{
                label: 'Ventas por categoría',
                backgroundColor: ['#0a0a0a', '#ff9800', '#ff9c00', '#ffa500'],
                data: [3000, 2000, 1500, 4000] // Simulación de ventas en cada categoría
            }]
        };

        // Configuración del gráfico
        var options = {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        };

        // Crear el gráfico circular
        var ctx = document.getElementById('ventasChart').getContext('2d');
        var ventasChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>


@endsection
