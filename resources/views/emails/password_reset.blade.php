<html>
    <head>
        <title>Смена пароля</title>
    </head>
    <body>
        <h1>ITGeekz Tasks</h1>
        Пройдите по этой ссылке для смены пароля
        <a href="{{ config('app.vue_url') }}/reset?email={{ $user->email }}&token={{ $token }}">
            {{ config('app.vue_url') }}/reset?email={{ $user->email }}&token={{ $token }}
        </a>
    </body>
</html>