# KeyDistributionSystem

## Setup Notes

1. Import db/keydist.sql.
2. Set up a virtual host in apache. 
    - This is done so that Document Root is "/" and files can be directly linked without ../ traversal)
    
    1. For windows and XAMPP
        1. Add following code at end of files.
            * hosts -> C:\Windows\System32\drivers\etc
        
                    127.0.0.1       localhost
                    127.0.0.1       testsite.com

            * httpd-vhosts.conf -> <Location>\xampp\apache\conf\extra
            
                    <VirtualHost *:80>
                        ServerName localhost
                        DocumentRoot "C:/xampp/htdocs"
                    </VirtualHost>
                    <VirtualHost *:80>
                        ServerName testsite.com
                        ServerAlias testsite.com
                        DocumentRoot "C:/xampp/htdocs/testsite"
                      <Directory "C:\xampp\htdocs\testsite">
                        Order allow,deny
                        Allow from all
                      </Directory>
                    </VirtualHost>
	
	1. For Linux
	    * https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts

<hr>

## Coding Notes

### Temporary Hooks

* Can register new users (for the time being) through following link
    * www.testsite.test/scripts/register.php?uname=admin1&role=0&pass=admin
* For user role numbers, check class/UserRole.php.

### Class structure

// TODO
