<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .header{
            display: grid;
            grid-template-columns: auto auto auto;
            grid-gap: 10px;
            text-align: center;
        }

        .header .content{
            margin: 10px 0px 10px 0px;
        }

        .header .content p{
            margin: 0;
        }

        hr{
            position: relative;
            margin-left: 50px;
            margin-right: 50px;
            border: none;
            height: 5px;
            background: black;
            margin-bottom: 50px;
        }

        .body{
            margin: 0px 50px 0px 50px;
        }

        .body p{
            margin: 0;
        }

        #logo-kiri{
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }
        #logo-kanan{
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div>
        <div class="header">
            <img src="{{asset("assets/dist/img/bontang.png")}}" id="logo-kiri" alt="">
            <div class="content">
                <p>PEMERINTAH KOTA BONTANG</p>
                <P>SDN NO.001 BONTANG UTARA TERAKREDITASI "a"</P>
                <P>ALAMAT : JL.KAPTEN PIERE TENDEAN NO.77, TELP.( 0548 ) 29165</P>
                <P>FAX ( 0548 ) 29165, EMAIL sdn004@gmail.com BONTANG</P>
            </div>
            <img src="{{asset("assets/dist/img/sd-001-bontang-utara.jpeg")}}" id="logo-kanan" alt="">
        </div>
        <hr>
        <div class="body">
            <p style="text-align: right">Bontang, 28 September 2021</p>
            <br>
            <table>
                <tr>
                    <td><p>No</p></td>
                    <td><p>: {{$outcomingLetter->ref_number}}</p></td>
                </tr>
                <tr>
                    <td><p>Lampiran</p></td>
                    <td>: -</td>
                </tr>
                <tr>
                    <td><p>Hal</p></td>
                    <td><p>: <b>{{$outcomingLetter->purpose}}</b></p></td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <br>
            <img src="{{asset("assets/dist/img/bontang.png")}}" id="logo-kiri" alt="">
            {!!$outcomingLetter->content!!}
        </div>
    </div>
</body>
</html>
