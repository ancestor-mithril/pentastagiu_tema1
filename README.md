# pentastagiu_tema1
PENTASTAGIU_TEMA_1

* author: Stoica George

# Configurare: 

* fisierul create.php contine 4 constante pentru accesarea bazei de date si o constanta care defineste URI-ul unde este hostat serverul
    * ex : DB_HOST = 'localhost', DB_NAME = 'test', DB_USER = 'root', DB_PASS = ''
    * ex : WSITE_ROOT = 'http://localhost


# Intrebari:

Am incercat sa fac ca la fiecare accesare a unei rute (localhost/...) sa fie executat tot timpul index.php si acolo sa se realizeze o verificare si eventual o redirectare catre fisierul care trateaza acea situatie.

Nu am reusit asa ca am facut organizarea curenta pentru tema. Ar fi trebuit sa fac in fiecare fisier (store.php, etc) cate o clasa (Store, etc) ca sa pot sa tratez requesturile in index.php? 
