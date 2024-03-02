<?php
/**
 * @author Vasilis Neris
 * @package FusionLab_Ga4
 */


namespace FusionLab\Ga4\Model;

use Magento\Eav\Model\Entity\Attribute;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Exception\LocalizedException;


class ProductAttributeResolver
{

    private Attribute $attribute;

    private AdapterInterface $connection;

    private $loadedAttributes = [];

    /**
     * @param Attribute $attribute
     * @param ResourceConnection $connection
     */
    public function __construct(
        Attribute          $attribute,
        ResourceConnection $connection
    )
    {
        $this->attribute = $attribute;
        $this->connection = $connection->getConnection();
    }


    /**
     * @param int $attributeId
     * @return string
     */
    public function getAttributeLabel(int $attributeId): string
    {
        $attribute = $this->getAttribute($attributeId);
        return $attribute->getStoreLabel();
    }

    /**
     * @param int $attributeId
     * @param int $optionId
     * @return string
     */
    public function getAttributeValue(int $attributeId, int $optionId): string
    {
        $attribute = $this->getAttribute($attributeId);
        foreach ($attribute->getOptions() as $option) {
            if ((int)$option->getValue() === $optionId) {
                return $option->getLabel();
            }
        }

        return '';
    }

    /**
     * @param int $attributeId
     * @return Attribute|null
     */
    private function getAttribute(int $attributeId): ?Attribute
    {
        if (!array_key_exists($attributeId, $this->loadedAttributes)) {
            try {
                $this->loadedAttributes[$attributeId] = $this->attribute->loadByCode(4, $this->getAttributeCodeById($attributeId));
            } catch (LocalizedException $e) {
            }
        }
        return array_key_exists($attributeId, $this->loadedAttributes) ? $this->loadedAttributes[$attributeId] : null;
    }

    /**
     * @param int $attributeId
     * @return string|null
     */
    public function getAttributeCodeById(int $attributeId): ?string
    {
        $select = $this->connection->select()
            ->from('eav_attribute', ['attribute_code'])
            ->where('attribute_id = ? ', $attributeId);

        return $this->connection->fetchOne($select);
    }


}
