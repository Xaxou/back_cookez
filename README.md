<h1>Installation</h2>
<h3>Installation de symfony.</h3>
<a href="https://symfony.com/download">Télécharger symfony</a>
<h3>Installation de composer.</h3>
<a href="https://getcomposer.org/download/">Télécharger composer</a>
<h3>Installation de xampp.</h3>
<a href="https://www.apachefriends.org/fr/index.html">Télécharger xampp</a>
<hr>

<h3>Mise en place de la base de données.</h3>
<ul>
    <li><code>cd back_cookez</code></li>
    <li><code>composer install</code></li>
    <li><code>php bin/console doctrine:database:create</code></li>
    <li><code>php bin/console make:migration</code></li>
    <li><code>php bin/console doctrine:migrations:migrate</code></li>
</ul>
<hr>

<h3>Génération de la clé de sécurité</h3>
<h4>Installation de OpenSSL</h4>
<p>Télécharger OpenSSL via le lien suivant : <a href="https://slproweb.com/products/Win32OpenSSL.html"> Télécharger OpenSSL</a></p>
<p>Ne pas oublier de récupèrer le passphrase dans le fichier <code>.env</code></p>
<hr>
<p>Effectuer les commandes suivantes :</p>
<ul>
    <li><code>mkdir config\jwt</code></li>
    <li><code>C:\Program Files\OpenSSL-Win64\bin\openssl.exe</code></li>
    <li><code>genrsa -out config/jwt/private.pem -aes256 4096</code></li>
    <li><code>rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem</code></li>
</ul>
<h3>Démarrage du serveur.</h3>
<p><code>symfony server:start</code></p>


<p>Pour Docker : https://github.com/nanoninja/</p>
