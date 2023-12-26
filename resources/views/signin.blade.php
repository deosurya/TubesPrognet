<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KRS</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="resource\styles\signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="POST" action="https://api-group3-prognet.manpits.xyz/api/login">
            @csrf
            <img class="mb-4" src="resource\logo.png" alt="" width="72" height="85">
            <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

            <div class="form-floating mb-2">
                <input id="email" type="email" class="form-control" placeholder="name@example.com" autofocus>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input id="password" type="password" class="form-control" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-danger" type="submit">Sign in</button>
        </form>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        axios.post('https://api-group3-prognet.manpits.xyz/api/login', {
            email: email,
            password: password,
        })
        .then(function (response) {
            // Handle successful login (e.g., redirect)
            console.log(response.data);
            const token = response.data.token;
            localStorage.setItem('token', token);

            const redirectTo = response.data.redirectTo;
            window.location.href = redirectTo;
        })
        .catch(function (error) {
            // Handle login error
            console.error(error.response.data);
            alert('Login error: ' + error.response.data.message);
        });
    });
</script>

</html>
