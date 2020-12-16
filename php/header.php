<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="home.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket"></i> Shopping List
            </h3>
            <h4>
                 <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </h4>
        </a>
        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="list.php" class="nav-item nav-link active">
                    <h5 class="px-5 list">
                        <i class="fas fa-shopping-cart"></i> My Bag 
                        
                        <?php

                            if (isset($_SESSION['list'])){
                            $count = count($_SESSION['list']);
                            echo "<span id=\"list_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo "<span id=\"list_count\" class=\"text-warning bg-light\">0</span>";
                        }

                        ?>
                                                    

                        <a id="btnEmpty" href="list.php?action=empty">Empty Bag!!</a>
                        <?php
                            if(isset($_SESSION["list"])){
                            $count = 0;
                            $total = 0;}
                           
                        ?>	
                    </h5>
                </a>
            </div>
        </div>

    </nav>
</header>