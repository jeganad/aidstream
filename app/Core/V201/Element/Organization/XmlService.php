<?php namespace App\Core\V201\Element\Organization;

/**
 * Class XmlService
 * @package App\Core\V201\Element\Organization
 */
class XmlService extends XmlGenerator
{

    /**
     * validates organization data with xml schema
     * @param $organization
     * @param $organizationData
     * @param $settings
     * @param $orgElem
     * @return mixed
     */
    public function validateOrgSchema($organization, $organizationData, $settings, $orgElem)
    {
        $message = '';
        try {
            $xml = $this->getXml($organization, $organizationData, $settings, $orgElem);
            $xml->schemaValidate(app_path('/Core/V201/XmlSchema/iati-organisations-schema.xsd'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $message = str_replace('DOMDocument::schemaValidate(): ', '', $message);
        }

        return $message;
    }

    /**
     * generates xml from organization data
     * @param $organization
     * @param $organizationData
     * @param $settings
     * @param $orgElem
     */
    public function generateOrgXml($organization, $organizationData, $settings, $orgElem)
    {
        $this->generateXml($organization, $organizationData, $settings, $orgElem);
    }

}
