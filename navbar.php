<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #C4B472; color:white">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <?php if ($userlevel == 2) { ?>
                    <a class="nav-link" href="index.php" style=" color:white !important; font-weight: 600 !important;">Kids Dashboard</a>
                <?php } else { ?>
                    <a class="nav-link" href="index.php" style=" color:white !important; font-weight: 600 !important;">Guardian Dashboard</a>
                <?php } ?>

            </li>
            <?php if ($userlevel == 1) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php" style=" color:white !important; font-weight: 600 !important;">Profile Settings</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="kid-profile.php" style=" color:white !important; font-weight: 600 !important;">Kids Profiles</a>
                </li>
            <?php } ?>
        </ul>
        <a href="process.php" class="btn   my-2 my-sm-0" style=" background-color:#885D33 !important; color:white">Logout</a>
        </form>
    </div>
</nav>