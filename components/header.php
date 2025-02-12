<header class="contain">
    <div class="page">
        <h2><?php 
            if (isset($_GET["page"])) {
                echo $_GET["page"];
            } else {
                echo "<a id='home' href='/crudArtigoss/'>Home</a>";
            }
        ?></h2>
    </div>

    <nav class="navigation">
        <ul>
            <li>
                <?php 
                    if (isset($_GET["page"]) && $_GET["page"] == "Criar") {
                        echo "<a href='/crudArtigoss/index.php'>Home</a>";
                    } else {
                        echo "<a href='/crudArtigoss/criar.php?page=Criar'>Criar Artigo</a>";
                    }
                ?>
            </li>

            <li><a href="/crudArtigoss/imagens.php">Imagens</a></li>
        </ul>
    </nav>
</header>