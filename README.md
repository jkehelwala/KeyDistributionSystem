# KeyDistributionSystem

**Do not use the Temp branch except for browsing and code extraction. <br> Set up notes for Windows and Linux are at the end of this ReadMe.**

## Coding Notes

* Check following before merging with master, and update your database accordingly

        git diff master origin/master db/ 

### Temporary Hooks

* Can register new users (for the time being) through following link
    * http://testsite.test/scripts/register.php?uname=admin1&role=0&pass=admin
    * Credentials

            admin1      admin
            machine1    machine
            sysadmin1   sysadmin

* For user role numbers, check class/UserRole.php.
* For logout (Due to session redirection to homepage)
    * http://testsite.test/index.php?logout=1

### Class structure

#### Coding Instructions
* Public functions and variables, refactoring of JK's current classes to be done.
* MVC architecture. Views in outer folders. Model in class folder. Control in scripts folder
* UserAuth inheritance checks according to the user role whether the child class (which can actually perform functions) can be instantiated
* Capabilities class holds what functions can be performed by which user. These are added in UserAuth sublcass to "capabilities" property. 
* Capabilities property is passed to object functions (KeyRequest, Key add/edit/view etc) when called.
* Each object function checks the Capabilities property whether it is allowed. (Enum value should be in Capabilities array)


#### Restrictions
**Certain properties are inaccessible to users, make minimum privilege based decisions when coding**

* Requests should be added with Admin Approval column set to NULL. So if rejected it becomes 0, if approved it becomes 1. 
* Regular users cant update requests, Only Add them.
* Admins can't view/edit keys.
* SysAdmins can't view requesting user.  

#### Class Diagram

[Rough Draft PDF](db/class_diagram.pdf)

If there are major structural changes to this, we'll update is as we go. 
If not, we'll update it when the code is done.

<hr>

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

