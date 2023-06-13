<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            .absen {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            .absen1 {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            .absen td,
            .absen th {
                border: 1px solid #ddd;
                padding: 8px;
            }
            .absen1 td,
            .absen1 th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .absen tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .absen tr:hover {
                background-color: #ddd;
            }

            .absen th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #0416b6;
                color: white;
            }
            .absen1 th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: red;
                color: white;
            }

            .label{
                font-family: Arial, Helvetica, sans-serif !important;
                font-weight: 400;
            }

            .title{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100px;
                width: 100%;
            }
            .title-i{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100px;
                width: 100%;
                margin-top: 9rem;
            }

            .sub-title{
                font-weight: 700;
                font-size: 20px;
                display: inline-block;
                vertical-align: middle;
                line-height: normal;
                padding-left: 1rem;
            }
            .hero{
                display: block;
                width: 65px;
            }
            .absen .crimson{
                background-color: crimson !important;
            }
        </style>
    </head>

    <body>


        </table>
        <div class="title-i">
            <img class="hero" src="{{ $base64 }}" >
            <span class="sub-title">Rekab Absensi PT. Surya Amanah Cendekia</span>
        </div>
        <p class="label">Izin</p>
        <table class="absen1">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Shift</th>
                <th>Client</th>
                <th>Jam Masuk</th>
                <th>Keterangan</th>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach ($izin as $arr)

            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $arr->user->name }}</td>
                <td>{{ $arr->shift->shift_name }}</td>
                <td>{{ $arr->kerjasama->client->name }}</td>
                <td>{{ $arr->absensi_type_masuk }}</td>
                <td style="color:red; text-decoration: underline;">Izin</td>
            </tr>
            @endforeach

        </table>
    </body>

    </html>
</body>

</html>
