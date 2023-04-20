<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BatukApp</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">


    </head>
    <body class="p-3 mb-2 bg-dark text-light">

        <div class="container">

            <h1 class="text-center">BATUKAPP</h1>

            <div class="row">
                <div class="col-6 px-3">
                    <div class="row p-3 mb-2 bg-dark bg-gradient rounded-4">
                        <h3>Calendari</h3>
                        <hr>

                        <div class="p-3 mb-2 bg-light text-dark">
                            Mes actual <br>
                            Mes actual <br>
                            Mes actual <br>
                            Mes actual <br>
                            Mes actual <br>
                        </div>

                        <a class="btn btn-danger" href="/prova">Obrir Calendari</a>
                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="row p-3 mb-2 bg-dark bg-gradient rounded-4">
                        <h3>Temes</h3>
                        <hr>

                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">#1</label>
                            </div>
                            <div class="col-9">
                                <label class="form-label"><b>Tema 1</b></label>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger" onclick="reproduir('TEMA 1')">PLAY</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">#2</label>
                            </div>
                            <div class="col-9">
                                <label class="form-label"><b>Tema 2</b></label>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger" onclick="reproduir('TEMA 2')">PLAY</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">#3</label>
                            </div>
                            <div class="col-9">
                                <label class="form-label"><b>Tema 3</b></label>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger" onclick="reproduir('TEMA 3')">PLAY</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <label class="form-label">#4</label>
                            </div>
                            <div class="col-9">
                                <label class="form-label"><b>Tema 4</b></label>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger" onclick="reproduir('TEMA 4')">PLAY</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 px-3">
                    <div class="row p-3 mb-2 bg-dark bg-gradient rounded-4">
                        <h3>Perfil</h3>
                        <hr>

                        <label class="form-label"><b>Nom:</b> NOM_USUARI</label>
                        <label class="form-label"><b>Cognom:</b> NOM_USUARI</label>
                        <label class="form-label"><b>Instruments:</b></label>
                            <label class="form-label">FOREACH dels INSTRUMENTS de cada USER</label>
                            <label class="form-label">FOREACH dels INSTRUMENTS de cada USER</label>
                            <label class="form-label">FOREACH dels INSTRUMENTS de cada USER</label>
                            <label class="form-label">FOREACH dels INSTRUMENTS de cada USER</label>

                        <a class="btn btn-danger" href="/prova">Editar Perfil</a>

                    </div>
                </div>
                <div class="col-6 px-3">
                    <div class="row p-3 mb-2 bg-dark bg-gradient rounded-4">
                        <h3>Composar</h3>
                        <hr>
                    </div>
                </div>
            </div>

        </div>



        <script>
            function reproduir(tema)
            {
                alert(tema);
            }
        </script>
    </body>
</html>
