<?php

/**
 * Abstract Shipping Response
 *
 * @author Wojciech Brozyna <http://vobro.systems>
 */

namespace thm\tnt_ec\service\ShippingService;

use thm\tnt_ec\service\AbstractResponse;

abstract class AbstractShippingResponse extends AbstractResponse
{
    
    /**
     * Catch run time errors
     *
     * @return void
     */
    protected function catchRuntimeErrors()
    {
        if (isset($this->simpleXml->Incomplete) === true && isset($this->simpleXml->Incomplete->RuntimeError) === true) {
            $this->hasError = true;

            $error['CODE'] = $this->simpleXml->Incomplete->RuntimeError->Code;
            $error['DESC'] = $this->simpleXml->Incomplete->RuntimeError->Message;

            array_push($this->errors, $error);
        }
    }

    /**
     * Catch validation errors
     *
     * @return void
     */
    protected function catchValidationErrors()
    {
          
        if (isset($this->simpleXml->ERROR) === false) {
            return null;
        }
        
        $this->hasError = true;

        foreach ($this->simpleXml->ERROR as $xml) {
            $error['CODE'] = $xml->CODE->__toString();
            $error['DESC'] = $xml->DESCRIPTION->__toString();
            $error['SOURCE'] = $xml->SOURCE->__toString();

            array_push($this->errors, $error);
        }
    }
}
