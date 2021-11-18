@extends('adminlte::page')

@section('title', 'SISTEMA POAI')

@section('content_header')
    <h1>Grafica Resultante:</h1>


    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
@stop

@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Descripcion
        </p>
    </figure>

    <script type="text/javascript">
        
        var data = <?php echo json_encode($datas)?>;
        var metasTot = <?php echo json_encode($metasTot)?>;
        var gerencia = <?php echo json_encode($gerencia)?>;
        var coordinacion = <?php echo json_encode($coordinacion)?>;

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Porcentaje Avance Metas Av(%) Sistema POAI '+gerencia
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    'Rangos Avance Meta'

                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Porcentaje Avance (%) <b>Total Metas: '+metasTot+'</b>'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} (%)</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Av% <= 20%',
                color: 'red',
                data: [data[0]]

            }, {
                name: '20% > Av% <= 80%',
                color: 'yellow',
                data: [data[1]]

            }, {
                name: 'Av% > 80%',
                color: 'green',
                data: [data[2]]

            }]
        });
    </script>
@stop
