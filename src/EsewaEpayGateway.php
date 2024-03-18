<?php


namespace Pasls\OmnipayEsewa;


use Omnipay\Common\AbstractGateway;

class EsewaEpayGateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "eSewa ePay";
    }

    public function getDefaultParameters()
    {
        return [
            'serviceCode'   =>  "",
            'testMode'      =>  false
        ];
    }

    public function switchToTestMode()
    {
        $this->setParameter('testMode', true);
    }

    public function switchToLiveMode()
    {
        $this->setParameter('testMode', false);
    }

    public function getServiceCode()
    {
        return $this->getParameter('serviceCode');
    }

    public function setServiceCode($serviceCode)
    {
        $this->setParameter("serviceCode", $serviceCode);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayEsewa\Message\EpayPostAuthorizeRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayEsewa\Message\EpayCompletePurchaseRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayEsewa\Message\EpayPostAuthorizeRequest', $parameters);
    }
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Pasls\OmnipayEsewa\Message\EpayCompletePurchaseRequest', $parameters);
    }
} 