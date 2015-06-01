INTRODUCTION
------------

miniOrange SAML SSO module provides secure access to Drupal for enterprises and
full control over access of applications, Single Sign On (SSO) into Drupal with
one set of login credentials.

REQUIREMENTS
------------

You need to have a valid miniOrange account in order to use this module.

INSTALLATION
------------

1. Login as administrator in Drupal.
2. Goto Modules and then click on Install new module.
3. Now upload the zip file and click on Install.
4. After successful installation, Enable the miniOrange module which you will
   find in Modules under SAML AUTHENTICATION.
   
CONFIGURATION
-------------

1. Login as a customer from Admin Console of miniOrange Administrator Console,
   now go to Apps tab from menu and select Configure Apps.
2. Search for Drupal, select the Drupal app and click on Add App.
3. Make sure the ACS URL is <path-to-drupal-site>/miniorange_samlauth/acs.
4. Click on Save to configure Drupal.
5. After configuring Drupal successfully, a Default policy is added for your 
   Drupal app and you can edit it under Policies section.
6. Download the certificate which you will need later while configuring the
   plugin.
7. Login as administrator in Drupal.
8. Click on Modules, find miniOrange module under SAML AUTHENTICATION and click
   on Configure under Operations column.
9. Provide the required settings (i.e. IdP Entity Id, Single Sign On Service 
   Url, X.509 certificate). In X.509 certificate field copy and paste the
   certificate downloaded in Step 1 from miniOrange Admin console and save it.

NOTE: After successfully completing all the steps, you will find Login with 
	  miniOrange link on your drupal login page.
