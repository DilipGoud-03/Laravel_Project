<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recieve Mail </title>
</head>

<body>
    <h2>
        This is Mail for Email Verification
    </h2>
    <p>A new user has register in Your website </p>
    <p>user details</p>
    <p>Name : <b>{{$recieveMailData['name']}}</b></p>
    <p>Email : <b>{{$recieveMailData['email']}}</b></p>
    <p>Password : <b>{{$recieveMailData['password']}}</b></p>
    <p> Click to verify user </p>
    <a href="{{ route('userVerify',$recieveMailData['token']) }}"><button type="sbumit" class="btn btn-primary btn-sm">Verify Email</button></a>
</body>

</html>