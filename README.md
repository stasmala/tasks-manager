<p>Регистрация пользователя</p>
<p>------------</p>
<p>/api/register</p>
<code>{
    "name": "rabotasmala",
    "email": "rabotasmala@gmail.com",
    "password": "rabotasmala",
    "password_confirmation": "rabotasmala"
}</code>
<p>============================================</p>
<p></p>
--------------------------------------------
Получить токен пользователя
----
/api/login
{
    "email": "rabotasmala@gmail.com",
    "password": "rabotasmala"
}
-- ОТВЕТ
{
    "token": "1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4"
}
===============================================

-----------------------------------------------
Создать задачу
------
/api/tasks/create
Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4
------------------
{
    "status": "todo",
    "priority": 3,
    "title": "Новая задача",
    "description": "Описание новой задачи"
}
===========================================================

----------------------------------------------------------
Список задач
------------
/api/tasks
Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4
--------------------
{
    "status": "todo",
    "priority": 3,
    "title": "зад",
    "sortBy": "priority",
    "sort": "ASC"
}
---------------------------

----------------------------------------------------------
Обновить задачу
------------
/api/tasks/update/1
Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4
--------------------
{
    "status": "todo",
    "priority": 3,
    "title": "Новая задача2",
    "description": "Описание новой задачи"
}
---------------------------

----------------------------------------------------------
Отметить задачу как выполненная
------------
/api/tasks/comlete/1
Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4
---------------------------
