# Admoura plugin de CakePHP 3

## Considerações
Admoura é um plugin feito em cakePHP 3 para administração de usuários.

## Instalação

Antes da instalação certifique-se que o banco de dados está configurado na sua aplicação.

Somente depois rode os comandos abaixo:

```
$ composer require --dev adrianodemoura/admoura
```

```
$ bin/cake migrations migrate -p admoura
```

```
$ bin/cake migrations seed -p admoura
```
