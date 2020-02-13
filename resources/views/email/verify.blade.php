<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    main {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #2c3e50;
    }

    a {
        text-decoration: none;
        color: #fff;
        background: #2c3e50;
        padding: 7px;
        text-align: center;
        border-radius: 7px;
        display: block;
        margin: 0 auto;
    }

    p {
        padding: 3px 0;
    }

    div {
        border-radius: 10px;
        max-width: 400px;
        background: #f8f9fa;
        color: #2c3e50;
        padding: 15px;
    }

    .logo {
        text-align: center;
        padding: 10px 0;
    }

    .logo img {
        width: 60px;
    }

    .text {
        text-align: center;
    }
</style>

<body>
    <main>
        <div>
            <div class="logo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF7wWJQDadluaVdvseV_qlx2QRNgkwc2wUFw2JfbkGsDWv9spMig&s"
                    alt="">
            </div>
            <p class="text">Hola <b>{{ $name }}</b> ,</p>

            <p>Gracias por crear una cuenta con nosotros. ¡No olvide completar su registro!
            </p>
            <p>Haga clic en el enlace a continuación o cópielo en la barra de direcciones de su navegador para confirmar
                su
                dirección de correo electrónico:</p>

            <br>

            <a href="{{ url('user/verify', $verification_code)}}">Confirmar mi dirección de correo electrónico </a>

            <br />
        </div>

    </main>

</body>

</html>