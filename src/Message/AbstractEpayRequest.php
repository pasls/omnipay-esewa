<?php
/**
 * Created by PhpStorm.
 * User: broncha
 * Date: 1/27/15
 * Time: 1:03 AM
 */

namespace Pasls\OmnipayEsewa\Message;


use Omnipay\Common\Message\AbstractRequest;

abstract class AbstractEpayRequest extends AbstractRequest
{
    private $testEndpoint = 'https://uat.esewa.com.np/epay/main';
    private $liveEndpoint = 'https://esewa.com.np/epay/main';

    private $testVerifyUrl = "https://uat.esewa.com.np/epay/transrec";
    private $liveVerifyUrl = "https://esewa.com.np/epay/transrec";

    public function getServiceCode()
    {
        return $this->getParameter('serviceCode');
    }

    public function setServiceCode($serviceCode)
    {
        $this->setParameter("serviceCode", $serviceCode);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getVerifyEndpoint()
    {
        return $this->getTestMode() ? $this->testVerifyUrl : $this->liveVerifyUrl;
    }
}