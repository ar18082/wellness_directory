
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('icone_connexion').style.display='none'; 
     

    document.getElementById('internauteBtn').addEventListener('click', function () {
        document.getElementById('FormInt').style.display = 'block';
        document.getElementById('typeUserBtn').style.display = 'none';
        document.getElementById('title_form').innerText= 'Formulaire Internaute';
        document.getElementById('P_Bar').style.display='flex';
        document.getElementById('Pro_Bar').style.width = '70%';


        
    });

    document.getElementById('prestataireBtn').addEventListener('click', function () {

        document.getElementById('FormPre').style.display='block'    
        document.getElementById('prestataireForm').style.display = 'grid';
        document.getElementById('stageForm').style.display = 'none';
        document.getElementById('promotionForm').style.display = 'none';
        document.getElementById('typeUserBtn').style.display = 'none';
        document.getElementById('title_form').innerText= 'Etape 1/3 : Prestataire';
        document.getElementById('P_Bar').style.display='flex';
        document.getElementById('Pro_Bar').style.width = '33%';
       
    });

    document.getElementById('submitprestataireForm').addEventListener('click', function(){
        
        document.getElementById('stageForm').style.display = 'grid';
        document.getElementById('prestataireForm').style.display = 'none';
        document.getElementById('title_form').innerText= 'Etape 2/3 : Stage';
        document.getElementById('Pro_Bar').style.width = '66%';

        
    });

    document.getElementById('submitStageForm').addEventListener('click', function(){  

        
        document.getElementById('stageForm').style.display = 'none';
        document.getElementById('promotionForm').style.display = 'grid';
        document.getElementById('title_form').innerText= 'Etape 3/3 : Promotion ';
        document.getElementById('Pro_Bar').style.width = '99%';

        document.getElementById('submit_pre').style.display ='block';

        console.log(datas);
    });

    



});

