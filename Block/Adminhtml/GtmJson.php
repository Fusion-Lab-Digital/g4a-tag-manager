<?php
/**
 * Copyright (c) 2025 Fusion Lab G.P
 * Website: https://fusionlab.gr
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
                'html_id' => $element->getHtmlId(),
                'json_config' => $this->generateButtonConfig($element),
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
