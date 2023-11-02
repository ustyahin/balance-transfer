# balance-transfer

## Разворачивание проекта:
1. Создаем базу данных `balance-transfer`
2. Выполняем команду:
````console
cp .env.example .env
````
Далее заполняем файл `.env` учитывая базу данных, пользователя базы данных и настрийки очереди:
````console
DB_DATABASE=balance-transfer
DB_USERNAME=root
DB_PASSWORD=root
QUEUE_CONNECTION=database
````
3. Выполняем команды:
````console
php artisan migrate
````
4. Запускаем в очередь (в одном терминале)
````console
php artisan queue:work
````
5. Запускаем в веб-сервер (в другом терминале)
````console
php artisan serve
````

## Условия задачи

Используя любой PHP-фреймворк создать приложение, которое имеет следующие
возможности: любой пользователь приложения может выбрать любого другого пользователя
приложения (кроме себя), чтобы сделать отложенный перевод денежных средств со своего
счета на счет выбранного пользователя. При планировании такого перевода пользователь
указывает сумму перевода в рублях, дату и время, когда нужно произвести перевод. Сумма
перевода ограничена балансом клиента на момент планирования перевода с учетом ранее
запланированных и невыполненных его исходящих переводов. Дата и время выбирается с
точностью до часа с использованием календаря. Способ выбора пользователя - любой (можно
просто ввод ID). Ввод данных должен валидироваться как на стороне клиента, так и на стороне
сервера с выводом ошибок пользователю.
Показать на сайте список всех пользователей и информацию об их одном последнем
переводе с помощью одного SQL-запроса к БД.
Реализовать сам процесс выполнения запланированных переводов. Не допустить
ситуации, при которой у какого-либо пользователя окажется отрицательный баланс.
Написанный для решения задачи код не должен содержать уязвимостей. Процесс
регистрации и проверки прав доступа можно не реализовывать. Для этого допустимо добавить
дополнительное поле ввода для указания текущего пользователя. Внешний вид страниц
значения не имеет.

Решение задачи должно содержать:

1. Весь текст поставленного тестового задания.
2. Четкую
   инструкцию
   по развертыванию проекта с целью
   работоспособности. Приветствуется использование Docker.
3. Миграции и сиды для наполнения БД демонстрационными данными.
   проверки
   его
