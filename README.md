<h1>Task Management API Installation and Setup Guide</h1>

<h2>Installation</h2>

  
    git clone https://github.com/stasmala/tasks-manager.git
    cd tasks-manager
    composer install
    cp .env.example .env
    php artisan key:generate

    Create a database and configure the connection in the .env file.

    Run database migrations:
    php artisan migrate

    Start the Laravel development server:
    php artisan serve


<h2>Usage</h2>
<h3>User Registration</h3>
<p><strong>Endpoint:</strong> <code>/api/register</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong> <code>name</code>, <code>email</code>, <code>password</code>, and <code>password_confirmation</code>.</p>

<h3>User Authentication</h3>
<p><strong>Endpoint:</strong> <code>/api/login</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong> <code>email</code> and <code>password</code>.</p>

<!-- Add more endpoint descriptions as needed -->

<h2>Dependencies</h2>
<ul>
    <li>PHP >= PHP 8.1.9</li>
    <li>Composer</li>
    <li>Laravel >= 10.24.0</li>
    <li>MySQL >= 8.0</li>
</ul>

<h2>Authors</h2>
<ul>
    <li>rabotasmala@gmail.com</li>
    <!-- Add other contributors if applicable -->
</ul>

<h2>License</h2>
<p>This project is licensed under the MIT License - see the <a href="LICENSE">LICENSE</a> file for details.</p>


<hr>



<h1>API Documentation</h1>

<h2>Authentication</h2>
<p>Your API requests must be authenticated using token-based authentication. Include an <code>Authorization</code> header with the value <code>Bearer YOUR_ACCESS_TOKEN</code> in your requests.</p>

<h2>Endpoints</h2>

<h3>Registration</h3>
<p><strong>Endpoint:</strong> <code>/api/register</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong></p>
<ul>
    <li><code>name</code> (string, required) - User's name</li>
    <li><code>email</code> (string, required) - User's email</li>
    <li><code>password</code> (string, required) - User's password (min 8 characters)</li>
    <li><code>password_confirmation</code> (string, required) - Password confirmation (must match <code>password</code>)</li>
</ul>
<p><strong>Response:</strong> A JSON object with a success message.</p>

<h3>Login</h3>
<p><strong>Endpoint:</strong> <code>/api/login</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong></p>
<ul>
    <li><code>email</code> (string, required) - User's email</li>
    <li><code>password</code> (string, required) - User's password</li>
</ul>
<p><strong>Response:</strong> A JSON object containing an access token.</p>

<h3>Get Tasks</h3>
<p><strong>Endpoint:</strong> <code>/api/tasks</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong></p>
<ul>
    <li><code>status</code> (string, optional) - Task status ("todo" or "done")</li>
    <li><code>priorityMin</code> (integer, optional) - Minimum priority</li>
    <li><code>priorityMax</code> (integer, optional) - Maximum priority</li>
    <li><code>title</code> (string, optional) - Task title (partial match)</li>
    <li><code>sortBy</code> (string, optional) - Field to sort tasks ("priority", "createdAt", or "completedAt")</li>
    <li><code>sort</code> (string, optional) - Sorting direction ("asc" or "desc")</li>
</ul>
<p><strong>Response:</strong> A JSON array containing the list of tasks that match the query parameters.</p>

<h3>Create Task</h3>
<p><strong>Endpoint:</strong> <code>/api/tasks/create</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>Request Parameters:</strong></p>
<ul>
    <li><code>status</code> (string, required) - Task status ("todo" or "done")</li>
    <li><code>priority</code> (integer, required) - Task priority</li>
    <li><code>title</code> (string, required) - Task title</li>
    <li><code>description</code> (string, optional) - Task description</li>
    <li><code>parent_id</code> (integer, optional) - Parent task ID (if this task is a subtask)</li>
</ul>
<p><strong>Response:</strong> A JSON object containing the created task details.</p>

<h3>Update Task</h3>
<p><strong>Endpoint:</strong> <code>/api/tasks/update/{id}</code></p>
<p><strong>Method:</strong> POST</p>
<p><strong>URL Parameters:</strong></p>
<ul>
    <li><code>id</code> (integer, required) - Task ID to update</li>
</ul>
<p><strong>Request Parameters:</strong></p>
<ul>
    <li><code>priority</code> (integer, optional) - Task priority</li>
    <li><code>title</code> (string, optional) - Task title</li>
    <li><code>description</code> (string, optional) - Task description</li>
</ul>
<p><strong>Response:</strong> A JSON object containing the updated task details.</p>

<h3>Complete Task</h3>
<p><strong>Endpoint:</strong> <code>/api/tasks/complete/{id}</code></p>
<p><strong>Method:</strong> GET</p>
<p><strong>URL Parameters:</strong></p>
<ul>
    <li><code>id</code> (integer, required) - Task ID to mark as completed</li>
</ul>
<p><strong>Response:</strong> A JSON object containing the completed task details.</p>

<h3>Delete Task</h3>
<p><strong>Endpoint:</strong> <code>/api/tasks/delete/{id}</code></p>
<p><strong>Method:</strong> GET</p>
<p><strong>URL Parameters:</strong></p>
<ul>
    <li><code>id</code> (integer, required) - Task ID to delete</li>
</ul>
<p><strong>Response:</strong> A successful response with status code 204 (No Content).</p>

<!-- Add more endpoints and descriptions as needed -->
