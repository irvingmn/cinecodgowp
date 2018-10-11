;
/* funciones anonimas (document, console y jquery) */
((d,c,$)=>{

c('hello Contact admin  Wordpress ')
c(contact_form)


/* the listener is asociate with document an only active in the class u-delete */
d.addEventListener('click', e=>{ /* funcion que captura el evento del click para saber quien lo origino  */
    if(e.target.matches('.u-delete')){ /*si  el click se va activar cuando el objeto que origino el evento consida con el siguiente selector */
        e.preventDefault()
        /* c(e.target.dataset.contactId), */ /* obtube el id de data html5 */
        let id = e.target.dataset.contactId,
        confirmDelete=confirm(`¿estas segurdo de elminar el coment con el ID ${id}?`)

        if(confirmDelete){ /*  */
            $.ajax({ /* llamo meto ajax de jquery */
                type:'post', /* la solisito por metodo post */
                data:{
                    'id':id,
                    'action':'cinecode_contact_form_delete' /* funcion que wp ejecutara en el backend  de lado de ajax*/
                },
                url:contact_form.ajax_url,/* el nombre del objerto(contact_form) y la propiedad del objto donde viene el ajax de wp es (ajax_url)*/
                success: data=>{
                    c(data) /* variable response */
                    let res = JSON.parse(data) /* codifique a objeto de js */  

                    if (!res.err) { /* elimina registro sin recargar */
                        let selectorId = '[data-contact-id="' + id + '"]'
                        c(selectorId)
                        d.querySelector(selectorId).parentElement.parentElement.remove() /* elimina todo el tr<td(fila) que se construyo dinamicamente */
                    }
                }
            })
        }else{
            return false; /*  no hace nada ya que retorna false */
        }
    } 

})
})(document,console.log,jQuery.noConflict());

