# 💻 Desafio de consumo de API Random Data.
Repositório criado como desafio prático para vaga de trabalho.

### Passo a passo:

Clone o repositório:
```sh
git clone https://github.com/giovannispa/random-data-viewer.git
```

Crie o Arquivo .env:
```sh
cp .env.example .env
```

Adicione as seguintes variáveis de ambiente do arquivo .env:
```dosini
ARGS_USER=teste
ARGS_UID=1000
```

# Subindo o projeto

Suba os containers do projeto:
```sh
docker-compose up -d
```

Acessar o container:
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto:
```sh
composer install
```

Gerar a key do projeto Laravel:
```sh
php artisan key:generate
```

Saia do container:
```sh
exit
```

Instale a node_modules:
```sh
docker-compose run --rm npm run dev
```

Inicie o vite:
```sh
docker-compose run --rm --service-ports npm run dev
```

Acesse a plataforma:
```sh
localhost
```
