<?php
/**
 * @package    miniOrange
 * @author	   miniOrange Security Software Pvt. Ltd.
 * @license    GNU/GPLv3
 * @copyright  Copyright 2015 miniOrange. All Rights Reserved.
 *
 *
 * This file is part of miniOrange SAML plugin.
 *
 */

include 'Utilities.php';

class miniOrange_AuthnRequest
{
	public function initiateLogin() 
	{
		// setting the acs url
		$acsUrl = $GLOBALS['base_url'] . '/miniorange_samlauth/acs';
		$issuer = 'miniorange-drupal-authentication-plugin';
		$ssoUrl = variable_get('saml_idp_sso');
		$samlRequest = Utilities::createAuthnRequest($acsUrl, $issuer);
		//echo $samlRequest;
		$redirect = $ssoUrl . '?SAMLRequest=' . $samlRequest;
		header('Location: '.$redirect);
	}

}
?>