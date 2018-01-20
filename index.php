<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'config.php';
        /*
          // Retorna apenas um registro
          $usuario = new Usuario();
          $usuario->loadByID(1);
          echo $usuario;
         */

        /*
          // Retorna todos os registros
          $lista = Usuario::getList();
          echo json_encode($lista);
         */
        /*
          // Retorna apenas os registros que contenham o valor pesquisado
          $search = Usuario::getSearch("j");
          echo json_encode($search);
         */

        /*
          // Retorna o registro caso tenha sido atenticado
          $login = new Usuario();
          $login->login("josenildo", "12345678909");
          echo $login;
         */

        // Faz um insert e retorna o id através de uma PROCEDURE
        $aluno = new Usuario();
        $aluno->setDesLogin("Juan");
        $aluno->setDesSenha('123456');

        $aluno->insert();
        echo $aluno;


        ?>
    </body>
</html>
