# KeyDistributionSystem

This is a key distribution system where regular users who are supposed to be developers can request keys to access machines. This will be approved by admins and then keys are created by sysadmins. 
The system has 3 types of Users. 
1.	Regular Users - Usually developers. They request keys from the system. Available machines are displayed so the users can request for a key of a specific type. 
2.	Administrator - Usually Team Leaders/ Scrum Masters. They are allowed to view the requests put by developer for the machines/servers they are in charge of.  They can approve or deny these requests.
3.	System Administrator - Usually Devops Personnel. They can view requests approved by administrators for the machines they are responsible of, and issue respective keys. They can also save maintenance notes along with a key for future reference. 


**Set up notes for Windows and Linux are at the end of this ReadMe.**

## Security -Todos

* Session Fixation Fixes - https://stackoverflow.com/a/5081453/3132503 (Most have to be configured using php.ini)
    * Session ID regen after loging out was added. 

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
* MVC architecture. Views in outer folders. Model in class folder. Control in scripts folder
* UserAuth inheritance checks according to the user role whether the child class (which can actually perform functions) can be instantiated
* Capabilities class holds what functions can be performed by which user. These are added in UserAuth sublcass to "capabilities" property. 
* Some capabilities are given on the go, such as DB Write access and Key encrypting and decrypting capabilities
* Capabilities property is passed to object functions (KeyRequest, Key add/edit/view etc) when called.
* Each object function checks the Capabilities property whether it is allowed. (Enum value should be in Capabilities array)


#### Restrictions
**Certain properties are inaccessible to users, make minimum privilege based decisions when coding**

* Requests should be added with Admin Approval column set to NULL. So if rejected it becomes 0, if approved it becomes 1. 
* Regular users cant update requests, Only Add them.
* Admins can't view/edit keys.
* SysAdmins can't view requesting user.  

#### Class Diagram

![ClassDiagram](https://raw.githubusercontent.com/jkehelwala/KeyDistributionSystem/master/db/ClassDiagram.png)

The methods/classes in Red are left to be implemented, along with their UI functionality.

<hr>

## Setup Notes

1. Import db/keydist.sql.
1. Update credentials at **init/cred.ini** and run following

        git update-index --assume-unchanged init/cred.ini

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

