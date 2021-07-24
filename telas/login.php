<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Acesso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

</head>

<body>


    <h1 class="container-fluid interno">Acesso</h1>

    <form action="login_select.php" method="post">

        <div class="container-fluid">
            <div class="interno">

                <div class="form-row">
                    <div class="col-sm-6 my-1">
                        <label>Usuário</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>

                    <div class="col-sm-6 my-1">
                        <label>Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>

                </div>
                <button type="submit" class="btn btn-success btn-lg float-right">Acessar</button>
            </div>
        </div>
    </form>

</body>

</html>