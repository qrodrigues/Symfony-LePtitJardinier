document.addEventListener("DOMContentLoaded", function () {
    var gestion = document.querySelector('.verticalGestion');
    var navGestion = document.querySelector('.navGestion');
    var navGestionCreation = document.querySelector('.navGestionCreation');
    var navGestionConsulter = document.querySelector('.navGestionConsulter');

    var client = document.querySelector('.verticalClient')
    var navClient = document.querySelector('.navClient');
    var navClientCreation = document.querySelector('.navClientCreation');
    var navClientConsulter = document.querySelector('.navClientConsulter');

    var devis = document.querySelector('.verticalDevis')
    var navDevis = document.querySelector('.navDevis');
    var navDevisCreation = document.querySelector('.navDevisCreation');
    var navDevisConsulter = document.querySelector('.navDevisConsulter');

    var navbarUl = document.querySelector('.navbarUl');

    navGestionCreation.remove();
    navGestionConsulter.remove();
    navClientCreation.remove();
    navClientConsulter.remove();
    navDevisCreation.remove();
    navDevisConsulter.remove();

    gestion.addEventListener('mouseover', function () {
        navGestion.remove();
        gestion.appendChild(navGestionCreation);
        gestion.appendChild(navGestionConsulter);
        navbarUl.style.width = '60%';
    });

    gestion.addEventListener('mouseout', function () {
        gestion.appendChild(navGestion);
        navGestionCreation.remove();
        navGestionConsulter.remove();
        navbarUl.style.width = '50%';
    });

    client.addEventListener('mouseover', function () {
        navClient.remove();
        client.appendChild(navClientCreation);
        client.appendChild(navClientConsulter);
        navbarUl.style.width = '60%';
    });

    client.addEventListener('mouseout', function () {
        client.appendChild(navClient);
        navClientCreation.remove();
        navClientConsulter.remove();
        navbarUl.style.width = '50%';
    });

    devis.addEventListener('mouseover', function () {
        navDevis.remove();
        devis.appendChild(navDevisCreation);
        devis.appendChild(navDevisConsulter);
        navbarUl.style.width = '60%';
    });

    devis.addEventListener('mouseout', function () {
        devis.appendChild(navDevis);
        navDevisCreation.remove();
        navDevisConsulter.remove();
        navbarUl.style.width = '50%';
    });
})