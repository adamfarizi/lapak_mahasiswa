<!DOCTYPE html>
<html>
    <head>
        <title>LAPAK MAHASISWA</title>
        <link rel="shortcut icon" href="../src/LOGO LM.png">
        <style>
            @font-face {
                font-family: 'Gladiora'; 
                src: url('../src/gladiora-regular.ttf');
            }
            .container{
                position: absolute;
                top: 20%;
                width: 98%;
                overflow: hidden;
                font-family: 'Gladiora';
                font-size: 20px;
                color:#faf9ed;
            }
            .button {
                background-color:#065776;
                font-family: 'Gladiora';
                border: none;
                color: #faf9ed;
                font-size: medium;
                width: 20%;
                padding: 10px 0;
                border-radius: 1em;
                cursor: pointer;
            }
            div button:hover{
                background-color:#04435B;
            }
        </style>
    </head>
    <body style="background-color: #0057BD;">
        <div class="container">
            <center><img src="../src/4.png" class="img" style="width: 200px;"></center> <br>
            <h1><center>BARANG BERHASIL DI INPUT !</center></h1> <br>
            <center><button onclick="window.location.href='../admin/index.php'" class="button">Kembali</button></center>
        </div>
    </body>
</html>