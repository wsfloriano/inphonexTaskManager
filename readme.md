<h1>Gerenciamento de tarefas</h1

Laravel 5.8

Foi utilizado para criação servidor Xampp com php 7.3 e MariaDB

Procedimento de Instalação

Git Clone

`` $ git clone git@github.com:wsfloriano/inphonexTaskManager.git ``  

Acesse a pasta do projeto e execute do comando do composer:

`` $ composer install ``

Banco de dados (MySQL)

Abra o banco de dados MySQL e crie o database (inphonex).

Na pasta raiz do projeto, configure o arquivo:  

.env  

```  
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=inphonex  
DB_USERNAME=root  
DB_PASSWORD=  
  
```  
*se necessário copie o arquivo ``.env.example``

Execute os comandos:

`` $ php artisan migrate  ``

``  $ php artisan db:seed  ``

Aplicação

Execute os comandos:  
  
``$ php artisan key:generate ``
  

`` $ php artisan serve  ``

No navegador, acesse o endereço http://127.0.0.1:8000/ para abrir o sistema, ou conforme suas configurações locais.
