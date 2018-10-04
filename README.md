# KeyDistributionSystem

1. Import db/keydist.sql.
2. Set up a virtual host in apache. Can do by editing following paths 

For windows and XAMPP, this can be done by editing
hosts -> C:\Windows\System32\drivers\etc
httpd-vhosts.conf -> C:\xampp\apache\conf\extra
	
<hr>

Can register new users (for the time being) through following command
www.testsite.test/scripts/register.php?uname=admin1&role=0&pass=admin

For role numbers, check class/UserRole.php.
