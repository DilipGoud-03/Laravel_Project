<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recieve Mail </title>
</head>

<body>
    <p>Thank you registering our website </p>
    <p>Your details</p>
    <p>Name : <b>{{$sendMailData['name']}}</b></p>
    <p>Email : <b>{{$sendMailData['email']}}</b></p>
    <p>Password : <b>{{$sendMailData['password']}}</b></p>

</body>

</html>