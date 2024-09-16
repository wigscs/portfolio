<nav class="main-nav">
    <div class="main-nav__avatar">
        <a href="index.php"><h1>SW</h1></a>
    </div>
    <div class="menu-container menu-container--collapsed">
        <ul class="main-nav__items">
            <li class="main-nav__item<?php echo $page == "about" ? ' active' : ''; ?>"><a href="about.php#about">About Me</a></li>
            <li class="main-nav__item<?php echo $page == "portfolio" ? ' active' : ''; ?>"><a href="index.php#portfolio">My Portfolio</a></li>
            <li class="main-nav__item<?php echo $page == "examples" ? ' active' : ''; ?>"><a href="examples.php#examples">Code Examples</a></li>
            <li class="main-nav__item<?php echo $page == "scs-scheme" ? ' active' : ''; ?>"><a href="scs-scheme.php#scs-scheme">SCS Scheme</a></li>
            <li class="main-nav__item"><a href="index.php#contact">Contact Me</a></li>
        </ul>
        <i class="menu-icon menu-icon--open fa-solid fa-bars"></i>
        <i class="menu-icon menu-icon--close fa-solid fa-x"></i>
    </div>
    <div class="main-nav__socials">
        <a target="_blank" href="https://github.com/wigscs"><i class="fa-brands fa-github"></i></a>
    </div>
</nav>