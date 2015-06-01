<?php
/**
 * This file is part of miniOrange SAML plugin.
 *
 */

include 'Assertion.php';
/**
 * Class for SAML2 Response messages.
 *
 */
class SAML2_Response
{
    /**
     * The assertions in this response.
     */
    private $assertions;

    /**
     * Constructor for SAML 2 response messages.
     *
     * @param DOMElement|NULL $xml The input message.
     */
    public function __construct(DOMElement $xml = NULL)
    {
        //parent::__construct('Response', $xml);

        $this->assertions = array();

        if ($xml === NULL) {
            return;
        }
		
		for ($node = $xml->firstChild; $node !== NULL; $node = $node->nextSibling) {
			if ($node->namespaceURI !== 'urn:oasis:names:tc:SAML:2.0:assertion') {
				continue;
			}

			if ($node->localName === 'Assertion') {
				$this->assertions[] = new SAML2_Assertion($node);
			}
			/*elseif ($node->localName === 'EncryptedAssertion') {
				$this->assertions[] = new SAML2_EncryptedAssertion($node);
			}*/
		}
    }

    /**
     * Retrieve the assertions in this response.
     *
     * @return SAML2_Assertion[]|SAML2_EncryptedAssertion[]
     */
    public function getAssertions()
    {
        return $this->assertions;
    }

    /**
     * Set the assertions that should be included in this response.
     *
     * @param SAML2_Assertion[]|SAML2_EncryptedAssertion[] The assertions.
     */
    public function setAssertions(array $assertions)
    {
        $this->assertions = $assertions;
    }

    /**
     * Convert the response message to an XML element.
     *
     * @return DOMElement This response.
     */
    /*public function toUnsignedXML()
    {
        $root = parent::toUnsignedXML();

        /** @var SAML2_Assertion|SAML2_EncryptedAssertion $assertion */
        /*foreach ($this->assertions as $assertion) {

            $assertion->toXML($root);
        }

        return $root;*/
    //}

}
