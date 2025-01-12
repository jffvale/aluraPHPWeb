<?php

$localServidor = "localhost";
$user = "root";
$senha = "";
$banco = "serenatto";

try {
    $pdo = new PDO("mysql:host=$localServidor;dbname=$banco", $user, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // var_dump($pdo); // Verificar se a conexão foi feita com sucesso
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

// var_dump($pdo); // Para testar a conexão (no terminal, C:\xampp\htdocs\aluraPhp\src> php conn.php).

/* Como vimos anteriormente, existe uma biblioteca nativa do PHP, a PDO. Ela é uma classe que nos permite fazer uma 
instância e utilizar vários métodos para manipular o banco de dados.

No arquivo "conn.php", criaremos uma variável $pdo que receberá new PDO():
É esperado que passemos o driver (tipo DB), então podemos fazer uma conexão com MySQL, SQLite, Postgre ou outro banco de dados. 
Neste caso, optamos por MySQL, por isso a string inicia com mysql.

Depois, inserimos a localização do banco no host, que é localhost). Para dbname, passamos o nome do banco, portanto 
dbname=serenatto. Em seguida, devemos passar o usuário que, como vimos anteriormente, é 'root'. Por fim, passamos a 
senha '' (senha em branco para esse caso).

Neste exemplo:
Você faz parte da equipe de desenvolvimento da Clínica Médica Voll e está trabalhando em um novo sistema de gerenciamento médico. 
Você precisa criar uma conexão entre PHP e MYSQL usando PDO para armazenar e recuperar informações sobre médicos, pacientes e consultas.
Considere que você possui as seguintes informações:

Servidor: localhost
Banco de dados: clinica_voll
Usuário: admin_voll
Senha: 12345

O comando ficará assim:

Em seguida, incluiremos o comando var_dump($pdo), para testar a conexão (no terminal, C:\xampp\htdocs\aluraPhp\src> php conn.php).
        se tudo estiver correto, o retorno será um objeto PDO, como o exemplo abaixo:
        PS C:\xampp\htdocs\aluraPhp\src> php conn.php
        object(PDO)#1 (0) {
        }
        Senão, será exibido um erro de conexão.

O code final do arquivo "conn.php" ficará assim, se usar o PDO:
 
$pdo = new PDO('mysql:host=localhost;dbname=clinica_voll', 'admin_voll', '12345');
var_dump($pdo);
*/