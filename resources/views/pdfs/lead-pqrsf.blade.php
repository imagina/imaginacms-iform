<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Lead Info</title>
    <style>
        html,
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #000;
            background: #fff;
        }

        /* ====== ENCABEZADO ======  */
        .header-grid td,
        .header-grid th {
            border-width: 2px;
        }

        .title-wrap {
            line-height: 1.25;
        }

        .title-wrap .kicker {
            font-weight: 700;
        }

        .title-wrap .doc-title {
            font-size: 14px;
            font-weight: 700;
        }

        .title-wrap .consec {
            font-weight: 700;
        }

        .logo-cell img {
            max-height: 40px;
            height: 40px;
            width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .title-info {
            text-align: center;
            background: #eef2f7;
        }


        /* ====== UTILIDADES ====== */
        .t-center {
            text-align: center;
        }

        .t-right {
            text-align: right;
        }

        .t-left {
            text-align: left;
        }

        .bold {
            font-weight: 700;
        }

        .small {
            font-size: 11px;
        }

        .font-13 {
            font-size: 13px;
        }

        .font-14 {
            font-size: 14px;
            margin-top: 5px;
        }

        .xs {
            font-size: 10px;
        }

        .mt-4 {
            margin-top: 4px;
        }

        .normal {
            font-weight: 400;
        }

        /* ====== TABLA BASE (CUADRÍCULA) ====== */
        table.grid {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .grid th,
        .grid td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .grid-c td {
            border: 0 !important;
        }

        .no-border {
            border: none !important;
        }

        .bg-gray {
            background: #eef2f7;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .doc-title {
            font-size: 14px;
            font-weight: 700;
            text-align: center;
        }

        /* ======  (para marcar con X) ====== */
        .box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            margin-right: 6px;
        }

        .box.mark {
            background-color: #000;
        }
    </style>
</head>

<body>

    <!--
        "nombre_completo_o_razón_social" => "Test 36"
        "cédula_o_nit" => "123456"
        "dirección_o_sucursal" => "Carrera 3 con 2"
        "ciudad" => "Ibague"
        "número_de_teléfono" => "123456"
        "correo_electrónico" => "elcorreo@adjkas.com"
        "reclamante_(si_aplica)" => "EL reclamante"
        "tipo_de_solicitud" => "Queja (Servicio)"
        "reporte" => "Seguridad y Salud en el Trabajo"
        "descripción_del_suceso..." => "asdadsadasdad"
        "autorizo_el_manejo_de_datos_personales" => "true"
    -->
    <section class="sheet">
        <table class="grid header-grid no-break">
            <tr>
                <td class="logo-cell" style="width: 23%">
                    <img src="https://s3.wasabisys.com/assets.colbitumen.com/assets/media/logos-principales/colbitumen.png"
                        alt="COLBITUMEN" />
                </td>
                <td class="t-center" style="width: 54%">
                    <div class="title-wrap">
                        <div class="kicker">FORMATO <span class="consec">N° ({{$codeIncrement}})</span></div>
                        <div class="doc-title">ATENCION DE QUEJA, RECLAMO, REPORTE, SUGERENCIA Y FELICITACIONES</div>
                    </div>
                </td>
                <td class="logo-cell t-right" style="width: 23%">
                    <img src="https://s3.wasabisys.com/assets.colbitumen.com/assets/media/logos-principales/asfalcargo.jpg"
                        alt="ASFALCARGO" />
                </td>
            </tr>
            <tr>
                <th class="t-left font-13">CÓDIGO: <span class="normal"> {{$codeForm}} </span></th>
                <th class="t-center font-13">VERSIÓN: <span class="normal">02</span></th>
                <th class="t-right font-13">FECHA: <span class="normal">{{$lead->created_at->format('Y/m/d')}}</span>
                </th>
            </tr>
        </table>

        <!-- ====== 1. DATOS DEL RECLAMANTE ====== -->
        <table class="grid no-break mt-4">
            <colgroup>
                <col style="width: 50%" />
                <col style="width: 50%" />
            </colgroup>
            <tr class="title-info">
                <th colspan="2">1. DATOS DEL RECLAMANTE</th>
            </tr>
            <tr>
                <td>
                    <div class="bold small">Nombre completo o razón social</div>
                    <div class="font-14">{{ $lead->values["nombre_completo_o_razón_social"]}}</div>
                </td>
                <td>
                    <div class="bold small">Cédula o NIT</div>
                    <div class="font-14">{{ $lead->values["cédula_o_nit"]}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="bold small">Dirección o sucursal</div>
                    <div class="font-14">{{ $lead->values["dirección_o_sucursal"]}}</div>
                </td>
                <td>
                    <div class="bold small">Ciudad</div>
                    <div class="font-14">{{ $lead->values["ciudad"]}}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="bold small">Número de Teléfono</div>
                    <div class="font-14">{{ $lead->values["número_de_teléfono"]}}</div>
                </td>
                <td>
                    <div class="bold small">Correo Electrónico</div>
                    <div class="font-14">{{ $lead->values["correo_electrónico"]}}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="bold small">Nombre de la persona que actúa en representación del reclamante (Si aplica)
                    </div>
                    <div class="font-14">{{ $lead->values["reclamante_(si_aplica)"]}}</div>
                </td>
            </tr>
        </table>

        <!-- ====== 2. TIPO DE SOLICITUD ====== -->
        <table class="grid no-break mt-4">
            <colgroup>
                <col style="width: 50%" />
                <col style="width: 50%" />
            </colgroup>
            <tr class="title-info">
                <th colspan="2">2. TIPO DE SUCESO (Solicitud/Reporte)</span></th>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table class="grid grid-c" style="border: none; border-collapse: collapse;">
                        <colgroup>
                            <col style="width: 40%" />
                            <col style="width: 60%" />
                        </colgroup>
                        <tr>
                            <th colspan="2" class="t-center bg-gray small" colspan="2">SOLICITUD</th>
                        </tr>
                        <tr>
                            <td colspan="2"> <span class="box "></span> {{ $lead->values["tipo_de_solicitud"]}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top;">
                    <table class="grid grid-c" style="border: none; border-collapse: collapse;">
                        <tr>
                            <th class="t-center bg-gray small" colspan="2">REPORTE</th>
                        </tr>
                        <tr>
                            <td colspan="2"><span class="box "></span> {{ $lead->values["reporte"]}}</td>
                        </tr>

                    </table>
                </td>
            </tr>
            <!-- <tr>
              <td colspan="2">
              <div class="bold small">Fecha de la concurrencia</div>
              <div class="font-14">Info</div>
            </td> -->
            </tr>
            <tr class="title-info">
                <th class="t-left" colspan="2">Descripción del Suceso:</th>
            </tr>
            <tr>
                <td colspan="2" class="area">{{ $lead->values["descripción_del_suceso..."]}}</td>
            </tr>
        </table>

    </section>
</body>

</html>