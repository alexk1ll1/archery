<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: loginError.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
          integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="styles.css">
    <title>Archery</title>

</head>
<body>
<!-- Nav Bar -->
<?php
require "navbar.element.php";
?>


<!--User Erstellen-->
<div class="container" id="createUserContainer">
    <div class="col text-center">
        <h2>User</h2>
        <form id="userForm">
            <div class="container">
                <div class="container" id="UserErstellung">
                    <div class="col text-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label for="fName" class="form-label">Vorname</label>
                                <input type="text" class="form-control" id="fName" name="fName"
                                       placeholder="Vorname">
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label for="lName" class="form-label">Nachname</label>
                                <input type="text" class="form-control" id="lName" name="lName"
                                       placeholder="Nachname">
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="row justify-content-center">
                            <div class="mb-3">
                                <label for="nName" class="form-label">Nickname</label>
                                <input type="text" class="form-control" id="nName" name="nName"
                                       placeholder="Nickname">
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"
                                    id="buttonCreateUser">
                                Erstellen
                            </button>

                            <a class="btn btn-primary" href="index.php"
                               role="button">Zur??ck</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--
<div class="container" id="createGameContainer">
    <div class="col text-center">
        <form method="post" action="" id="gameForm">
            <div class="container">
                <div class="col text-center">
                </div>
                <div class="container">
                    <div class="col text-center">
                        <div class="row justify-content-md-center">
                            <div class="mb-3">
                                <select class="selectpicker" id="userSelect" name="userSelect" multiple aria-label="Default select example" data-live-search="true">
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <option value="4">Four</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" id="buttonCreateUser">Erstellen
                            </button>
                            <button class="btn btn-primary" id="buttonCreateUserBackToMainMenu">Zur??ck
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
-->

<!-- JavaScript Bundle with Popper -->
<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="script.js"></script>

</body>

</html>