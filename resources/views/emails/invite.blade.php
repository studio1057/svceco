<html>
<head>

</head>
<body>

Hello {{ $first_name }},

        Please sign up for svcecoVile using this link <a href="{{ URL::to('/invite/' . $hash) }}"> Invite </a>

</body>
</html>