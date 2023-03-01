# Техническое Задание

Реализуйте на laravel простую новостную ленту с простым управлением содержимого.

## Стек

- MySQL/MariaDB

## Требования

На главной странице, расположенной на http://localhost:8000/ отображается список новостей отсортированный по дате и времени создания от новых к старым. С возможностью фильтрации по категории.

Заголовок новости ведёт на подробное описание новости (модальное окно или отдельная страница детальной новости)
Управление(создание, изменение, просмотр списка, удаление) списком новостей происходит со страницы http://localhost:8000/manager, обязательные поля к заполнению: Название(короткий текст), Текст(полный текст), Категория(короткий текст или выпадающий список).

Для клиентской части можно использовать Bootstrap.

## Дополнительно

По разработке задания возможно задавать вопросы, в случае недопонимания. Основной упор задания узнать уровень и способность мыслить разработчика отталкиваясь от описанных требований.

## Передача проекта

Проект размешается в публичном репозитории github.com. В описании проекта описывается инструкция «как запустить проект». Ссылка на репозиторий отсылается принимающему. Можно использовать сторонние библиотеки, кроме админки.

Готовую админку использовать нельзя, нам полноценная админка в тестовом задании не нужна, нужно управление данными, чтобы оценить насколько хорошо вы умеете пользоваться тем, что дает laravel.
