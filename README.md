Instalação

Clone o repositório:

    git clone https://github.com/RaildoBru/library-sistem-api.git

    cd library-sistem-api

Instale as dependências:

    composer install

    npm install

crie um arquivo .env usando .env.example

    php artisan migrate

    php artisan serve


para usar a fila é necessario execultar o comando 
    php artisan queue:work

documentação 

http://localhost:PORT/api/documentation
