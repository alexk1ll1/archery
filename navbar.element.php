<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" id="brand" href="index.php">
            <img src="./images/dinoColor.png" id="dino" alt="Dino" width="100" height="80"
                 class="d-inline-block align-text-top ">
        </a>
        <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="userLogin.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php">Statistiken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Anleitung.php">Anleitung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userRegistration.php">Registrieren</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    ';
} else {
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" id="brand" href="index.php">
            <img src="./images/dinoColor.png" id="dino" alt="Dino" width="100" height="80"
                 class="d-inline-block align-text-top ">
        </a>
        <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php">Statistiken</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Anleitung.php">Anleitung</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    ';
}
?>