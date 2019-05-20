# Admoura plugin de CakePHP 3

## Considerações
Admoura é um plugin feito em cakePHP 3 para administração de usuários.

## Instalação

Antes da instalação certifique-se que o banco de dados está configurado na sua aplicação.

Depois de verificar a conexão com o banco de dados abra o arquivo `src/Application.php` e acrescente a seguinte linha:

```
$this->addPlugin('admoura');
```
Dentro da função bootstrap.

Volte para o console e rode os comandos abaixo:

```
$ composer require --dev adrianodemoura/admoura
```

```
$ bin/cake migrations migrate -p Admoura
```

```
$ bin/cake migrations seed -p Admoura
```
