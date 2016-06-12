<div class="menu_block">
    <div class="container_12">
        <div class="grid_12">
            <nav class="">
                <ul class="sf-menu">
                    <li><a href="atualizacoes.php">Atualizações</a></li>
                    <li><a href="quem_somos.php">Quem somos</a></li>
                    <?php
                    //caso $pg_login seja FALSO não mostrar a opção sair no cabeçalho.
                    if(isset($pg_login) == FALSE){
                        echo "<li><a href='login.php'>Sair</a></li>";
                    }else{
                        isset($pg_login);
                    }
                    ?>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>