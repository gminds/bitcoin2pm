bitcoin2pm
==========

Bitcoin/Perfect Money Automatic Exchange Script



It exchanges perfect money for bitcoin. Prices of bitcoin is calculated from blockchain, this script provides a framework which you can easily adapt to build an automatic exchange website.

***

**Install the Script**

You need the following items when installing this script.
* A Perfect money account for receiving payment (USD)
* Perfect money Alternate Passphrase
* Mysql database, username and password


Login to your Perfect Money account and copy your USD account it begins with "U" for example U7994859

Copy your Perfect money Alternate phrase hash from your account settings

Create Mysql database, username and password on your hosting account. Note the database name, username and password

Open Phpmyadmin, Click on SQL to open the query window and run the queries inside the Sql folder BitcoinPerfectMoney

Inside the Bitcoin2pm folder, copy the sql queries inside the order file. Order file is inside the Sql folder, paste its content to the query window inside phpmyadmin and run 

![phpmyadmin](https://github.com/gminds/bitcoin2pm/blob/master/Documentation/assets/images/phpmyadmin1.JPG)


Edit the index.php file inside Files folder and change the configure the options from line 1 - 30 .

![notepad](https://github.com/gminds/bitcoin2pm/blob/master/Documentation/assets/images/notepade1.JPG)

***



**Upload files on your server **

Download and install the FileZilla Client - http://filezilla-project.org/

*     Open FileZilla
*     Fill in your FTP Credentials and click on "Quick connect"
*     Use the right side panel to navigate to your script folder
*     Use the left side panel to navigate to the place where you have extracted the script folder
*     Drag the extracted script folder into your web hosting
*     Wait until all files are uploaded

Note: you may be asked if you want to overwrite files and/or folder. Tick the option to "Always use this action" and click on "Ok". .



***

**Admin Backend**

Here's a brief information about how to configure this Admin.

![admin](https://github.com/gminds/bitcoin2pm/blob/master/Documentation/assets/images/notepad2.JPG)


You can access at admin backend from http://BASE_URL/admin

BASE_URL could be www.domain.com (if you put this script in a main domain), sub.domain.com (if you put this script in a subdomain) or www.domain.com/folder (if you put this script in a subfolder of the main domain).

Original access credentials are:
Username: demo
Password: demo 


***

**Sources and Credits - top**

I've used the following files as listed.

    SLIM Framework
    Paris and idiorm
    Twig

**Note**
This PM/bitcoin exchange script is semi-automated and you have to manually process orders.

Get Fully automated Premium version of Perfectmoney/bitcoin exchange script at http://easy2exchange.com