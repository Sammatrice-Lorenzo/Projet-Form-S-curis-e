<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous"
    >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="./style/style.css">

    <script src="./js/functions.js"></script>
    <script src="./js/jquery/JQuery_3.5.1.js"></script>

	<title>register</title>
</head>
<body>
    <div class="formWrapper">
        <form class='form'>
            <h1>S'enregistrer</h1>
            <img src="./img/img.png" alt="Form sécurisées">
            <div class="errors"></div>
            <input hidden='hidden' name='register'/>
            <div class="inputblock">
                <label for="name">Nom</label>
                <input id="name" name="name" type="text" autocomplete="name"
                    required placeholder="Entrez votre nom de famille" required="required"
                />
            </div>
            <div class="inputblock">
                <label for="name">Prénom</label>
                <input id="firstname" name="firstname" type="text" autocomplete="name"
                    required placeholder="Entrez votre prénom" required="required"
                />
            </div>
            <div class="inputblock">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Entrez votre email" />
            </div>
            <div class="inputblock">
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password"
                    autocomplete="new-password" placeholder="Entrez votre password"
                />
            </div>
            <div class="inputblock">
                <label for="confirm-password">Confirmer votre mot de passe</label>
                <input id="confirm-password" name="confirm-password" type="password"
                    autocomplete="new-password" placeholder="Confirmer votre password"
                />
            </div>
            <br>
            <a href="./index.php">Vous avez déjà a compte veuillez vous connecter</a>
        </form>
        <div class="container">
            <button class="btn btn-primary mt-2" type='submit' style="width: 200px;" onclick="register()">
                S'enregistrer
            </button>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary mt-2" onclick="reset('')" style="width: 200px;">
                Reset
            </button>
        </div>
    </div>
</body>
</html>
