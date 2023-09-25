<p>Регистрация пользователя</p>
<p>------------</p>
<p>/api/register</p>
<code>
{
    "name": "rabotasmala",
    "email": "rabotasmala@gmail.com",
    "password": "rabotasmala",
    "password_confirmation": "rabotasmala"
}</code>
<p>============================================</p>
<p></p>
<p></p>
<p>--------------------------------------------
<p>Получить токен пользователя</p>
<p>----</p>
<p>/api/login
<code>
{
    "email": "rabotasmala@gmail.com",
    "password": "rabotasmala"
}</code>
<p>-- ОТВЕТ</p>
<code>
{
    "token": "1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4"
}</code>
<p>===============================================</p>
<p></p>
<p></p>
<p>-----------------------------------------------</p>
<p>Создать задачу</p>
<p>------</p>
<p>/api/tasks/create</p>
<p>Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4</p>
<p>------------------</p>
<code>
{
    "status": "todo",
    "priority": 3,
    "title": "Новая задача",
    "description": "Описание новой задачи"
}</code>
<p>===========================================================</p>
<p></p>
<p></p>
<p>----------------------------------------------------------
<p>Список задач
<p>------------</p>
<p>/api/tasks</p>
<p>Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4</p>
<p>--------------------</p>
<code>
{
    "status": "todo",
    "priority": 3,
    "title": "зад",
    "sortBy": "priority",
    "sort": "ASC"
}</code>
<p>---------------------------</p>
<p></p>
<p></p>
<p>----------------------------------------------------------
<p>Обновить задачу</p>
<p>------------
<p>/api/tasks/update/1</p>
<p>Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4</p>
<p>--------------------</p>
<code>{
    "status": "todo",
    "priority": 3,
    "title": "Новая задача2",
    "description": "Описание новой задачи"
}</code>
<p>---------------------------</p>
<p></p>
<p></p>
<p>----------------------------------------------------------</p>
<p>Отметить задачу как выполненная</p>
<p>------------</p>
<p>/api/tasks/comlete/1</p>
<p>Bearer: 1|oKpp0SWnd4EW7mhZnXKpsAsRTdnNgVZfqwL5qSA55eda95f4</p>
<p>---------------------------</p>
