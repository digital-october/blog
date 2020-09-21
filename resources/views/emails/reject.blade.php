<!DOCTYPE html>
<html>
<head>
    <title>Rework post</title>
</head>

<body>
<h2>Ваша статья {{ $post['title'] }}</h2>
<br/>
Отклонена модератором со следующим комментарием:
<br>
{{ $post['message'] }}
</body>

</html>