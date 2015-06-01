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

include 'Response.php';
class miniOrange_Acs
{	

	public function processSAMLResponse() {
		
		if (array_key_exists('SAMLResponse', $_POST)) {
			$samlResponse = $_POST['SAMLResponse'];
		} else {
			throw new Exception('Missing SAMLRequest or SAMLResponse parameter.');
		}
		
		if(array_key_exists('RelayState', $_POST)) {
			$relayState = $_POST['RelayState'];
		} else {
			$relayState = '';
		}
		
		$samlResponse = base64_decode($samlResponse);
		$document = new DOMDocument();
		$document->loadXML($samlResponse);
		$samlResponseXml = $document->firstChild;
		
		$signatureData = Utilities::validateElement($samlResponseXml);
		if($signatureData !== FALSE) {
			$validSignature = Utilities::validateSignature($signatureData, variable_get('saml_idp_x509cert'));
			if($validSignature === FALSE) {
				throw new Exception('Invalid signature.');
			}
		}
		
		$samlResponse = new SAML2_Response($samlResponseXml);
		
		// verify the issuer and audience from saml response
		$acsUrl = $GLOBALS['base_url'] . '/miniorange_samlauth/acs';
		$issuer = variable_get('saml_idp_entityid');
		Utilities::validateIssuerAndAudience($samlResponse, $acsUrl, $issuer);
		
		$username = $samlResponse->getAssertions()[0]->getNameId()['Value'];
		
		return $username;
	}
	
	
	//$siteUrl = substr(JURI::base(), 0, strpos(JURI::base(), '/plugins'));
	//echo '<br />' . $siteUrl;
	//$urlToPost = $siteUrl . '/plugins/authentication/miniorangesaml/miniorangesaml.php';
	
	// set cookie for ssoemail
	//setcookie('ssoemail', $username, time() + 60000, '/');

	//header('Location: ' . $urlToPost);
	//echo $samlResponse->getAssertions()[0]->getCertificates()[0];
	//echo '<html><body>Please wait...<script>window.onload = function(){document.forms["saml-form"].submit();}</script><form id="saml-form" action="' . $urlToPost . '" method="post"><input type="hidden" name="username" value="' . $username . '"/></form></body></html>';	

}

?>