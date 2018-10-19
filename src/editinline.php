<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>
<body>
    <a href="#" id="username">superuser</a>
    <script>
        //turn to inline mode
        $.fn.editable.defaults.mode = 'popup';

        $(document).ready(function() {
            $('#username').editable();
        });

        $('#username').editable({
            type: 'text',
            pk: 1,
            url: '/post',
            title: 'Enter username'
        });
    </script>
</body>
</html>
