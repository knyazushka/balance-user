# Балансы пользователей

Тестовое задание "Балансы пользователей"

## Требование к стеку
- php8, laravel 10+
- postgresql/mysql
- jquery/vue
- scss/css, bootstrap5

при создании базы использовать laravel migrations

для js и css/scss использовать laravel mixe/vite

# Структура БД
Придумать структуру следующих таблиц:
- таблица пользователей
- таблица баланса пользователей
- таблица операций

# Структура сайта
- логин
- главная страница, отображает текущий баланс пользователя и пять последних операций. Обновление всех данных через T секунд
- история операций, отображает таблицу операций с сортировкой по полю "дата" и поиском по полю "описание"

# Бэкенд
Через консольную команду (artisan) сделать:
- добавление пользователей
- проведение операций по балансу пользователя. По логину (начисление/списание) с указанием описания операции, при этом не давать уводить баланс в минус

Отдельным плюсом будет реализация проведения операций по балансу с использованием laravel queues.


