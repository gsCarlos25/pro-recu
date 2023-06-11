<head>
<link rel="icon" type="image/x-icon" href="../favicon/icono.ico" />
</head>


<nav class="navBar" id="mainNav">
            <div class="container">                
                <a class='inicio' href='<?=base_url?>/index.php'>MeetSport</a>
                <a class='btn-menu' onClick="mostrarMenu()">Menu</a>
            </div>
            <div class="derecha" id="navbarResponsive">
                <ul class="elementos">
                    <li><a href='<?=base_url?>/assets/views/buscar-evento.php'>Buscar</a></li>
                    <li><a href='<?=base_url?>/assets/views/crear-evento.php'>Crear evento</a></li>
                    <li><a href='<?=base_url?>/assets/views/perfil.php'>Perfil</a></li>
                </ul>
            </div>
</nav>

<script>
    function mostrarMenu(){
        if($('.elementos').css("display") == "flex"){
            $('.elementos').css("display", "none")
        }else{
            $('.elementos').css("display", "flex")
        }
        
    }
</script>