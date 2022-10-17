## InfraWebNovo
Utilize docker-compose para subir em ambiente DEV de forma simples.
#### Requisitos
- Docker
- Docker-compose
- PHP 7.4+
- Composer
- Java JDK 1.6 Jasperphp

#### Passo a passo
1. Copiar o arquivo **.env.example** para o mesmo local com o nome **.env**

2. Copiar o arquivo **docker-compose.yml.example** para o mesmo local com o nome **docker-compose.yml**

3. Atualize as dependências do *PHP* com o comando:
```shell
composer install
```

4. Para baixar as bibliotecas que seram usadas pelas Views:
```shell
npm install
yarn install
```

5. Em caso de sucesso, execute o build das imagens do *Docker* executando o comando:
```shell
docker-compose up
```

**caso queira executar o *container* em segundo plano acrescente o atributo *-d***
```shell
docker-compose up -d
```

**qualquer erro no banco de dados basta removê-lo, após isso execute o build das imagens novamente:**
```shell
docker-compose down -v
```

6. Para gerar a chave de acesso que está no arquivo **.env**:
```shell
php artisan key:generate
```

6. Executar para migrar o banco infrawebnovo:
   1. Migrate geral
      ```shell
         php artisan migrate
      ```
7. Executar seeds para popular a tabela programs e ProgramsQuality:
   1. Seeds
      ```shell
         php artisan db:seed --clas="Programs"
         php artisan db:seed --clas="ProgramsQuality"
         php artisan db:seed --clas="ServerEveoCloud"
      ```

8. Caso de problema de permissões ou token das sessions use:
   1. Seeds
      ```shell
         php artisan cache:clear
         php artisan config:clear
         php artisan route:clear
      ```
9. Para testar a API das notifications:
   1. WebSockets
      ```shell
       php artisan websockets:serve
      ```
   2. Debugger Web
        ```shell
       http://127.0.0.1/laravel-websockets clicar em conectar
      ```