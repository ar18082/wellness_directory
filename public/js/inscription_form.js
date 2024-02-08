    // ne pas oublié de récupéré l'id user et d'inserer la data 
      var datas = {
        role: '',
        file: '',
        utilisateur_id: '',
        prestataire:{
            nom: '',
            tva: '',
            telephone: '',
            adresse: '',
            number: '',
            cp: '',
            commune: '',
            site: '',
                        
        },

        internaute:{
            nom: '',
            prenom: '',
            adresse: '',
            number: '',
            cp: '',
            commune: '',
            newsletter:'',
            
        },
        
        stage: {
            nom_stg: '',
            description_stg: '',
            tarif_stg: '',
            date_debut_stg: '',
            date_fin_stg: '', 
            affichage_debut : '',
            affichage_fin : '',
        },
        promotion: {
            nom_promo: '',
            description_promo: '',
            date_debut_promo: '',
            date_fin_promo: ''

        }
};

    
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('icone_connexion').style.display='none';
        //console.log("ok ")
        // Écoutez le clic sur le bouton "Suivant"
        document.getElementById('prestataireBtn').addEventListener('click', function () {
            // Récupérez les valeurs des checkboxes
            var prestataire = "PRE";
            console.log(prestataire);
            document.getElementById('prestataireForm').style.display = 'grid';
            document.getElementById('typeUserBtn').style.display = 'none';
            document.getElementById('title_form').innerText= 'Etape 1/3 : Prestataire';
            document.getElementById('P_Bar').style.display='flex';
            document.getElementById('Pro_Bar').style.width = '33%';
           
        });
        
        document.getElementById('internauteBtn').addEventListener('click', function () {
            // Récupérez les valeurs des checkboxes
            var internaute = "INT" ;
            console.log(internaute);
            document.getElementById('internauteForm').style.display = 'grid';
            document.getElementById('typeUserBtn').style.display = 'none';
            document.getElementById('title_form').innerText= 'Formulaire Internaute';
            document.getElementById('P_Bar').style.display='flex';
            document.getElementById('Pro_Bar').style.width = '70%';
        });

       
           
        document.getElementById('submitInternauteForm').addEventListener('click', function(){
            if (newsletter_int.checked) {
                newsletter = 'on';
            } else {
                newsletter = 'off';
            };
            
                            
                datas.internaute.nom       =        document.getElementById('nom_int').value,
                datas.internaute.prenom    =        document.getElementById("prenom_int").value,
                datas.internaute.adresse   =        document.getElementById("rue_int").value,
                datas.internaute.number    =        document.getElementById("numero_int").value,   
                datas.internaute.cp        =        document.getElementById("code_postal_int").value,
                datas.internaute.commune   =        document.getElementById("commune_int").value,
                datas.file      =        document.getElementById("formFile_int").value,
                datas.internaute.newsletter =        newsletter,
                datas.role     =        "INT",
          
            //console.log(datas);
            document.getElementById('internauteForm').style.display = 'none';
            document.getElementById('title_form').innerText= 'Inscription terminée ';
            document.getElementById('Pro_Bar').style.width = '100%';

             var data = {'un': 'test'};

             console.log(data); 
            axios.post('/inscription/json/', data, {hearders : {
                'Content-Type' : 'json'
            }})

            .then(response => {
               
                console.log(response.data);
            })
            .catch(error => {
                
                console.error('Erreur lors de la requête Axios', error);
            });
            

        });
        document.getElementById('submitprestataireForm').addEventListener('click', function(){
            
            
            datas.prestataire.nom        =        document.getElementById('nom_pre').value;
            datas.prestataire.tva        =        document.getElementById('tva_pre').value;
            datas.prestataire.telephone  =        document.getElementById('telephone_pre').value; 
            datas.prestataire.adresse    =        document.getElementById("rue_pre").value;
            datas.prestataire.number     =        document.getElementById("numero_pre").value;  
            datas.prestataire.cp         =        document.getElementById("code_postal_pre").value;
            datas.prestataire.commune    =        document.getElementById("commune_pre").value;
            datas.prestataire.site       =        document.getElementById("site_internet_pre").value;
            datas.file       =        document.getElementById("formFile_pre").value;
            datas.role       =        "PRE",
           

            
            document.getElementById('stageForm').style.display = 'grid';
            document.getElementById('prestataireForm').style.display = 'none';
            document.getElementById('title_form').innerText= 'Etape 2/3 : Stage';
            document.getElementById('Pro_Bar').style.width = '66%';

            console.log(datas);
        });
        document.getElementById('submitStageForm').addEventListener('click', function(){
            
            
            
            datas.stage.nom_stg                 =        document.getElementById('nom_stg').value,
            datas.stage.description_stg         =        document.getElementById('description_stg').value, 
            datas.stage.tarif_stg               =        document.getElementById("tarif_stg").value,
            datas.stage.date_debut_stg          =        document.getElementById("dateIn_stg").value,   
            datas.stage.date_fin_stg            =        document.getElementById("dateOut_stg").value,
            datas.stage.affichage_debut         =        document.getElementById("affichageIn_stg").value,
            datas.stage.affichage_fin           =        document.getElementById("affichageOut_stg").value,    
        

            
            document.getElementById('stageForm').style.display = 'none';
            document.getElementById('promotionForm').style.display = 'grid';
            document.getElementById('title_form').innerText= 'Etape 3/3 : Promotion ';
            document.getElementById('Pro_Bar').style.width = '99%';

            console.log(datas);
        });

        document.getElementById('submitPromotionForm').addEventListener('click', function(){

            datas.promotion.nom_promo         =        document.getElementById('nom_promo').value;
            datas.promotion.description_promo =        document.getElementById('description_promo').value; 
            datas.promotion.date_debut_promo  =        document.getElementById("dateIn_promo").value;   
            datas.promotion.date_fin_promo    =        document.getElementById("dateOut_promo").value;

            document.getElementById('title_form').innerText= 'Inscription terminée ';
            document.getElementById('promotionForm').style.display = 'none';
            document.getElementById('Pro_Bar').style.width = '100%';
            console.log(datas);

            axios.post('/inscription/json', datas)
            .then(response => {
               
                console.log(response.data);
            })
            .catch(error => {
                
                console.error('Erreur lors de la requête Axios', error);
            });
        });
            
        
    }); 


