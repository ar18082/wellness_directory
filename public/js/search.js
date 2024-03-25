

jQuery('.select_ville_CP_region').select2({
        placeholder: 'entrez un code postale, une region ou une ville ',
        ajax: {
            url: '/Region-ville-CodePostal',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
    
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.CodePost + ': ' + item.ville,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
});

jQuery('.select_categorieDeServices').select2({
    placeholder: 'entrez un service ',
    ajax: {
        url: '/categorieDeServicesAjax',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {

            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.nom,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

jQuery('.select_prestataire').select2({
    placeholder: 'entrez un prestataire ',
    ajax: {
        url: '/prestataireAjax',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.nom,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});


var btnFormSearch = document.getElementById('btn_FormSearch');

btnFormSearch.addEventListener('click', function(){
    var prestataire = document.getElementById('select_prestataire').value;
    var categorieDeServices = document.getElementById('select_categorieDeServices').value;
    var ville_CP_region = document.getElementById('select_ville_CP_region').value;
     // Créez un objet contenant vos données à envoyer
     var data = {
        prestataire: prestataire,
        categorieDeServices: categorieDeServices,
        ville_CP_region: ville_CP_region
    };

    // Envoyez la requête POST avec les données JSON
    fetch('/ResultSearchAjax', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function(response) {
        // Gérez la réponse ici
        console.log(response);
    }).catch(function(error) {
        // Gérez les erreurs ici
        console.error('Erreur:', error);
    });

});






