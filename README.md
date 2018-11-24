laravel-ulogin Laravel Package
=========================

Пакет который позволяет авторизоваться через соцсети с помощью сервиса uLogin (https://ulogin.ru/)


Требования к ПО
------------

- PHP >= 7.0

- Laravel >= 5

Перед установкой необходимо добавить стандартную авторизацию Laravel с помощью команды

`php artisan make:auth`

Установка
------------

`composer require brizhanev/laravel-ulogin`
```

`php artisan vendor:publish`

`php artisan migrate`

Использование
---

Вставить в шаблоне `<?=Form::uLogin()?>` или `<?=Form::uLogin(['mode'=>'window'])?>`
