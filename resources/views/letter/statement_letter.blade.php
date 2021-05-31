<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <style>
        body{
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <p>Surat Keterangan</p>
    </div>
    <br><br>
    <div>
        <p>Yang bertanda tangan di bawah ini, Kepala Sekolah {{$student->school->name}} dengan ini menyatakan bahwa :</p>
    </div>
    <br>
    <div>
        <table>
                <tr>
                    <th>Nama </th>
                    <td>: {{$student->name}}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal lahir </th>
                    <td>: {{$student->birth_place}}, {{date('d-m-Y', strtotime($student->birth_date))}}</td>
                </tr>
                <tr>
                    <th>Nama Orang Tua </th>
                    <td>: {{$student->father_name}}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin </th>
                    <td>: {{$student->gender}}</td>
                </tr>
                <tr>
                    <th>Agama </th>
                    <td>: {{$student->religion}}</td>
                </tr>
        </table>
    </div>
    <br>
    <div>
        <p>Dengan ini menerangkan bahwa nama yang tersebut diatas benar telah menamatkan pendidikan di Sekolah {{$student->school->name}} pada tahun {{$student->graduated_year}} dengan nomor Ijazah {{$student->ijazah_number}}.
            Demikian surat keterangan ini dibuat sebagai pengganti Ijazah yang sah.</p>
    </div>
    <br>
    <div class="text-right">
        <p>Bontang, {{date('d M Y', strtotime($student->birth_date))}} &nbsp;&nbsp;</p>
        <p>Kepala {{$student->school->name}}</p>
    </div>
</body>
</html>
