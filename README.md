# Grape
 Проект сайту катихитичної комісії

Для інсталяції проекту необхідно клонувати директорію та запустити composer install або update<br>
Скопіювати файл .env.example та перейменувати на .env в якому потрібно змінити дані до вашого локального середовища<br>
Запустіть команду composer update для завантаження пакетів<br>
Запустіть команду php artisan key:generate для генерації унікального ключа в файлі .env<br>
Запустіть команду php artisan migrate для створення таблиць в базі даних<br>
Запустіть команду php artisan serve для запуску застосунку або налаштуйте ваш сервер щоб він дивився в папку grape/public<br><br><br>

Фронт частина буде працювати за замовчуванням.<br>
Для розробки фронт частини потрібно налаштувати середовище<br>
Виконайте команду npm install<br>
Та виконайте команду npm run watch - вочер буде слідкувати за змінами та перезбирати проект після внесення змін
<br><br>
API URL<br><br>

/*
Без авторизації
*/<br>
/api/register {method:POST} - приймає <br>
		{<br>
			name:'name',<br>
			surname:'surname',<br>
			email:'email', - унікальний<br>
			password:'password',<br>
			birthday: date,<br>
			address: 'string'<br>
		}<br>
/*
Для авторизованих
*/		<br>
/api/user {method:GET}- повертає список користувачів<br><br>
/api/user/id {method:GET}- повертає користувача по id<br><br>
/api/user/id {method:PUT}- редагує користувача по id<br><br>
/api/user/id {method:DELETE}- видаляє користувача по id


