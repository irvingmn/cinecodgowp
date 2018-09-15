<?php
    get_header();

    if(is_home()){
        echo '<mark>PAGIANA DEL HOME</mark>';
    }elseif(is_category()){
        echo'<mark>PAGIANA DEL LAS CATEGORIAS</mark>';
    
    }elseif(is_page()){
        echo'<mark>Es un pagina</mark>';
    
    }elseif(is_single()){
        echo'<mark>PAGIANA DEL UN POST</mark>';
    
    }elseif(is_search()){
        echo'<mark>PAGIANA DEL RESULTADO DE BUSQUEDAS</mark>';
    }

    get_template_part('content');
    get_sidebar();
    get_footer();

        
   