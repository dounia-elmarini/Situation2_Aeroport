
$(function () {
    // Document.ready -> link up remove event handler
    $(".deleteLink").click(function () {
        // R�cup�ration de la ligne en cours
        var oTR = $(this).parent().parent();
        // R�cup�ration de l'id de la compagnie : row-NUMERO -> suppression de 'row-'
        var idCompagnie = oTR.attr("id").substring(4);
        // R�cup�ration du titre
        var titre = oTR.find("#compagnieNom").html();
        
        if (idCompagnie != '' && confirm("Voulez-vous supprimer la compagnie '" + titre + "' ? "))
        {
            // Affiche l'image d'attente
            $('#loader').show('slow', null);
            
            // Perform the ajax post
           
            $.ajax({
                url: "compagnie/delete",
                type: "post",
                data: { "id": idCompagnie },
                success: function(data){
                    if (data.status == 0) {
                        $('#row-' + data.id).fadeOut('slow');
                        $('#update-message').attr("class", 'label label-success');
                    }
                    else
                        $('#update-message').attr("class", 'label label-important');
                    $('#update-message').text(data.message);
                    $('#update-message').show('slow', null).delay(6000).hide('slow');
                },
                error:function(){l
                    alert("Erreur d'acc�s � la m�thode de suppression");
                }   
            });
            // Cache l'image d'attente
			$('#loader').hide();
        }
    });
});

