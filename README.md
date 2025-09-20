Projeto Sugestão de Filmes (MVC em PHP)
Uma aplicação web simples construída com PHP puro seguindo o padrão arquitetural MVC (Model-View-Controller), com camadas de Serviço e de Acesso a Dados (DAO) bem definidas. O projeto permite o gerenciamento de filmes, categorias e avaliações, servindo como um estudo de caso prático para a construção de aplicações PHP estruturadas sem o uso de frameworks.

🚧 Status: Projeto em construção para fins acadêmicos e supervisionado pelo professor Humberto Patrick.




✨ Funcionalidades
CRUD completo para Filmes: Adicionar, Editar, Listar e Excluir filmes.

CRUD completo para Categorias: Adicionar, Editar, Listar e Excluir categorias.

CRUD completo para Avaliações: Adicionar, Editar, Listar e Excluir avaliações.

Sistema de Roteamento com URLs Amigáveis: URLs limpas e intuitivas (ex: /filme/listar).

Lógica de Negócio na Camada de Serviço:

Cálculo de média de notas para avaliações de um mesmo filme.

Validações para evitar dados inconsistentes.

Trava de Integridade: Ao excluir uma categoria, os filmes associados não são apagados, apenas desvinculados, permitindo uma nova categorização.

Interatividade com JavaScript: Preenchimento automático e bloqueio de campos no formulário de avaliação para garantir a consistência dos dados.




🚀 Tecnologias Utilizadas
Backend: PHP 8.2+

Servidor: Apache (via XAMPP)

Banco de Dados: MySQL / MariaDB

Frontend: HTML, CSS e JavaScript (Vanilla JS para chamadas AJAX/Fetch)




⚙️ Instalação e Execução
Siga os passos abaixo para rodar o projeto em um ambiente local.

1. Pré-requisitos:

Ter o XAMPP (ou similar) instalado e com os módulos Apache e MySQL rodando.

2. Clonar o Repositório:

Bash

git clone [https://github.com/Welcleys/movies-suggestions]
cd movies-suggestions
(Ou simplesmente copie a pasta do projeto para C:/xampp/htdocs/)

3. Configurar o Banco de Dados:

Abra o phpMyAdmin (http://localhost/phpmyadmin).

Crie um novo banco de dados. O nome padrão usado no projeto é sugestoes_filmes.

Importe o arquivo database.sql (se você tiver um) para criar todas as tabelas e relacionamentos necessários.
(Dica: É uma boa prática exportar seu banco de dados final e salvar o arquivo .sql na raiz do projeto)




4. Configurar a Conexão:

Abra o arquivo generic/MysqlSingleton.php.

Verifique se as credenciais de conexão (nome do banco, usuário, senha) estão corretas para o seu ambiente local:

PHP

$this->dns = "mysql:host=localhost;dbname=sugestoes_filmes;charset=utf8";
$this->username = "root";
$this->password = "";




5. Configurar as URLs Amigáveis (Opcional, mas recomendado):

Garanta que o arquivo .htaccess está na raiz do projeto (/movies-suggestions/).

Verifique se a configuração do Apache (httpd.conf) permite a sobrescrita de regras (AllowOverride All) e que o mod_rewrite está ativo, conforme discutimos.




6. Acessar o Projeto:

Abra seu navegador e acesse: http://localhost/movies-suggestions/




📂 Estrutura do Projeto
A aplicação segue uma arquitetura MVC em camadas para uma clara separação de responsabilidades.

/controller: Recebe as requisições do usuário, aciona a lógica de negócio e seleciona a view a ser exibida.

/service: Contém a lógica de negócio da aplicação. É a única camada que pode falar com o DAO. As classes de "Modelo" ou "Entidade" (como Filme.php) também residem aqui.

/dao: Camada de Acesso a Dados (Data Access Object). Responsável por toda a comunicação (consultas SQL) com o banco de dados. Contém as interfaces (IFilmeDAO) e as implementações (mysql/FilmeDAO).

/generic: Classes e scripts genéricos que dão suporte à aplicação, como o roteador, autoloader e a conexão com o banco (Singleton e Factory).

/public: Arquivos de View (HTML + PHP) que são responsáveis pela apresentação dos dados ao usuário.

index.php: Ponto de Entrada Único (Front Controller). Todas as requisições passam por ele.

.htaccess: Configuração do Apache para habilitar as URLs amigáveis.




👨‍💻 Autores
Feito com ❤️ por [Alexsandro e Welcleys].

GitHub: [https://github.com/0A8LE1X2] e [https://github.com/Welcleys]

😊😊😊😊😊