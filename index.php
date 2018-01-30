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
          $login->login("Login1", "123456");
          echo $login;
         */

        /*
          // Faz um insert e retorna o id através de uma PROCEDURE
          $aluno = new Usuario('Aluno1', '123456');
          $aluno->insert();
          echo $aluno;
         */

        /*
          // Atualiza o registro do banco de dados
          $ususario = new Usuario();
          $ususario->loadByID(16);
          $ususario->update('professor', '123456');
          echo $ususario;
         */

        // Atualiza o registro do banco de dados
        $ususario = new Usuario();
        $ususario->loadByID(19);
//        $ususario->delete();
        echo $ususario;
        ?>
    </body>
</html>
