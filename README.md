# local.tchat
## Environnement
- Windows 10
- WampServer 3.1.0
- PHP 5.6
- Apache 2.4.27
- MySql 5.7.19


##Configuration de Bd
 
  1.Importer le fichier Sql qui se trouve dans le répertoire `C:\wamp64\www\local.tchat\db\db_tchat.sql` dans phpmyadmin
  2.Éditer le fichier paramerters.php qui se trouve dans le répertoire 'C:\wamp64\www\local.tchat\config\' :
  
      return $parameters = [
          "databases" =>
              [
                  "DBHOST" => '127.0.0.1',
                  "DBNAME" => 'bd_tchat',
                  "DBUSER" => 'root',
                  "DBMDP"  => '',
              ],
          "parameters"=>[
              "PATHAPP"=>'http://local.tchat/index',
          ]
      ];
      

##Configuration VHOST

1.Placer vous dans la repertoire  `C:\wamp64\bin\apache\apache2.4.27\conf\extra\`
puis ajouter le vhost ci-dessous dans le fichier suivant `httpd-vhosts.conf`

    <VirtualHost *:80>
        ServerName local.tchat
        DocumentRoot "c:/wamp64/www/local.tchat/web"
        <Directory  "c:/wamp64/www/local.tchat/web/">
            Options +Indexes +Includes +FollowSymLinks +MultiViews
            AllowOverride All
            Require local
        </Directory>
    </VirtualHost>

 2.Il faut ajouter la ligne suivante dans vos fichier hosts `(C:\Windows\System32\drivers\etc\hosts)` : 
        
        127.0.0.1 local.tchat
        
 3.Redémarrer les services de WampServer 
    
Voici le lien de test: http://malek.tchat.viatorlab.com/
