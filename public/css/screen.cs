@charset "UTF-8";
/* couleurs*/
/*Fond d'écran*/
/*media quieri*/
html {
  font-size: 14px;
  font-family: "Roboto", sans-serif;
  max-width: 1250px;
  margin: 1rem auto;
}

body {
  color: #000;
  margin: 0 auto;
}

button {
  background-color: #87d02a;
  color: #fff;
}

h1, h2, h3 {
  text-align: center;
  margin: 2rem;
  color: #87d02a;
}

.logo-container {
  text-align: center;
}
.logo-container .logo_picture {
  width: 60%;
  margin: 2rem auto;
}

.icon_login {
  margin: 1rem;
}
.icon_login .bi {
  width: 20px;
  height: 20px;
}
.icon_login .btn {
  margin: 1rem 0;
  padding: 0.3rem;
}

@media screen and (min-width: 850px) {
  .h-header {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    margin: 1rem auto;
    height: 10rem;
  }
  .logo-container {
    grid-column: 4/5;
    margin: 1rem auto;
    width: 100%;
    margin: 3rem 0rem 1rem 12rem;
  }
  .icon_login {
    grid-column: 1;
    top: -6.5rem;
    left: 0rem;
  }
}
.h-hamburger-icon {
  font-size: 3rem;
  position: absolute;
  right: 3rem;
  top: 2.5rem;
  color: #000;
}

.navigation {
  display: none;
  position: absolute;
  width: 90%;
  left: 0rem;
  top: 14rem;
}
.navigation.is-active {
  display: block;
  z-index: 1;
}
.navigation ul {
  background-color: #87d02a;
  padding: 1rem;
  margin: 1rem;
  text-align: center;
  list-style: none;
  height: 680px;
  width: 100%;
  position: absolute;
  top: -8rem;
  opacity: 0.9;
  display: flex;
  flex-direction: column;
}
.navigation li {
  margin: 0rem 0rem 0.7rem;
}
.navigation a {
  text-decoration: none;
  color: #fff;
  font-size: 1rem;
  font-weight: bold;
}

@media screen and (min-width: 850px) {
  .h-hamburger-icon .fa {
    display: none;
  }
  .navigation {
    display: block;
    width: 100%;
    height: 2rem;
    top: 2.3rem;
    text-align: center;
  }
  .navigation ul {
    display: inline;
    background: none;
    padding: 0;
    margin: 0;
    text-align: center;
    list-style: none;
    position: relative;
    top: 4.5rem;
  }
  .navigation li {
    display: inline;
    padding: 0.5rem 0.5rem 0;
    background-color: #87d02a;
    text-align: center;
    border-radius: 0.375rem;
    position: relative;
  }
  .navigation a {
    text-decoration: none;
    text-align: center;
    position: relative;
    bottom: 0.5rem;
    font-size: 1rem;
    font-weight: bold;
  }
}
.main_homePage {
  display: grid; /* Utilise le modèle de disposition flexbox */
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 10px;
  grid-auto-rows: minmax(100px, auto);
}

#sidebar {
  width: 200px; /* Ajuste la largeur de la sidebar selon tes besoins */
  background-color: #87d02a;
  padding: 10px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Ajoute une ombre à la bordure droite */
  grid-column: 1/2;
  grid-row: 1/5;
}
#sidebar h2 {
  color: #fff;
}

.categorieDeServices_list {
  list-style-type: none;
  padding: 0;
  width: 7rem;
  margin: 1rem auto;
}

.categorieDeServices_list li {
  margin-bottom: 10px; /* Ajoute un espace entre chaque élément de la liste */
  padding: 0rem;
}

.categorieDeServices_list a {
  text-decoration: none;
  color: #87d02a;
  display: block;
  padding: 1rem 0rem;
  margin: 3rem -2rem;
  background-color: #fff;
  border-radius: 5px;
  transition: background-color 0.3s ease; /* Ajoute une transition pour une animation fluide */
  text-align: center;
}

.categorieDeServices_list a:hover {
  background-color: #000; /* Change la couleur de fond au survol */
}

.container_slider {
  grid-column: 2/4;
}

.container_recherche {
  grid-column: 2/5;
  grid-row: 2;
}

.containerSearch_form {
  width: 537px;
  height: 228px;
  flex-shrink: 0;
  border-radius: 10px;
  background: #C9D8B7;
  margin-left: 1rem;
}
.containerSearch_form .formSearch {
  display: grid; /* Utilise le modèle de disposition flexbox */
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 10px;
  grid-auto-rows: minmax(100px, auto);
}

.formPrestaire {
  grid-column: 1/5;
  grid-row: 1/5;
  margin: 1rem;
}
.formPrestaire input {
  width: 452px;
  height: 36.207px;
  flex-shrink: 0;
  border-radius: 10px;
  background: linear-gradient(0deg, rgba(252, 251, 251, 0.59) 0%, rgba(252, 251, 251, 0.59) 100%), linear-gradient(0deg, rgba(252, 251, 251, 0.59) 0%, rgba(252, 251, 251, 0.59) 100%), rgba(252, 251, 251, 0.59);
}

.formRegion {
  grid-column: 1;
  grid-row: 2;
}

.formVille {
  grid-column: 2;
  grid-row: 2;
}

.formCp {
  grid-column: 3;
  grid-row: 2;
}

.formSubmit {
  grid-column: 3;
  grid-row: 2;
  margin-top: 5rem;
}

.container_serviceEnAvant {
  grid-column: 2/3;
  grid-row: 2;
  margin-left: 47rem;
}

/*# sourceMappingURL=screen.cs.map */
