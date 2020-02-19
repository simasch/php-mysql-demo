<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            HR
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $page == 'index' ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?= $page == 'employees' ? 'active' : '' ?>">
                    <a class="nav-link" href="employees.php">Employees</a>
                </li>
            </ul>
            <div>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<a class="text-light" href="logout.php">Logout (' . $_SESSION['user'] . ')</a>';
                } else {
                    echo '<a class="text-light" href="login.php">Login</a>';
                }
                ?>
            </div>
        </div>
    </nav>
</header>
