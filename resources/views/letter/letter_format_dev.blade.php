<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .header{

        }

        .header .content{
            margin: 10px 0px 10px 0px;
            text-align: center;
        }

        .header .content p{
            margin: 0;
        }

        /* hr{
            position: relative;
            margin-left: 50px;
            margin-right: 50px;
            border: none;
            height: 5px;
            background: black;
            margin-bottom: 50px;
        } */

        .body{
            margin: 0px 50px 0px 50px;
        }

        .body p{
            margin: 0;
        }

        #logo-kiri,#logo-kanan{
            text-align: center;
        }

        #logo-kiri img{
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }
        #logo-kanan img{
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }
        table{
            width: 100%;
        }
    </style>
</head>
<body>
    <div>
        <div class="header">
            <table>
                <tr>
                    <td id="logo-kiri"><img src="{{asset("assets/dist/img/bontang.png")}}" alt=""></td>
                    <td>
                        <div class="content">
                            <p>PEMERINTAH KOTA BONTANG</p>
                            <P>SDN NO.001 BONTANG UTARA TERAKREDITASI "A"</P>
                            <P>ALAMAT : JL.KAPTEN PIERE TENDEAN NO.77, TELP.( 0548 ) 29165</P>
                            <P>FAX ( 0548 ) 29165, EMAIL sdn004@gmail.com BONTANG</P>
                        </div>
                    </td>
                    <td id="logo-kanan"><img src="{{asset("assets/dist/img/sd-001-bontang-utara.jpeg")}}" alt=""></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="body">
            <p style="text-align: right">Bontang, 28 September 2021</p>
            <br>
            <table>
                <tr>
                    <td style="width:10%"><p>No</p></td>
                    <td><p>: {{$outcomingLetter->ref_number}}</p></td>
                </tr>
                <tr>
                    <td style="width:10%"><p>Lampiran</p></td>
                    <td><p>: -</p></td>
                </tr>
                <tr>
                    <td style="width:10%"><p>Hal</p></td>
                    <td><p>: {{$outcomingLetter->purpose}}</p></td>
                </tr>
            </table>
            <br>
            <br>
            {!!$outcomingLetter->content!!}
            <br>
            <br>
            <p style="text-align: right">Mengetahui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p style="text-align: right">Kepala SDN 001 Bontang Utara</p>
            <br>
            <br>
            <br>
            <br>
            <p style="text-align: right"><b>Yani Astutik, M.Pd</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p style="text-align: right"><b>NIP. 19830110 2009042001</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
    </div>
</body>
</html>
