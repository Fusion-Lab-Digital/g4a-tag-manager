<?php

/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */

namespace FusionLab\Ga4\Block\Adminhtml;


use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Serialize\Serializer\Json;

class GtmJson extends Field
{

    protected $_template = 'FusionLab_Ga4::json-download.phtml';

    /**
     * @var Json
     */
    private $jsonEncoder;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param Json $jsonEncoder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        Json $jsonEncoder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->jsonEncoder = $jsonEncoder;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->addData(
            [
                'button_label' => __('Download Json'),
                'json_config' => $this->generateButtonConfig($element),
                'html_id' => $element->getHtmlId()
            ]
        );

        return $this->_toHtml();
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    private function generateButtonConfig(AbstractElement $element)
    {
        $result = ['elementId' => $element->getHtmlId()];
        return $this->jsonEncoder->serialize($result);
    }

    /**
     * @return string
     */
    public function getJsonFileUrl()
    {
        return $this->getViewFileUrl('FusionLab_Ga4::ga4_gtm_setup.json');
    }

}
