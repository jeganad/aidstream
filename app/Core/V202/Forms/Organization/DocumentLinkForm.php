<?php namespace App\Core\V202\Forms\Organization;

use App\Core\Form\BaseForm;

/**
 * Class DocumentLinkForm
 * @package App\Core\V202\Forms\Organization
 */
class DocumentLinkForm extends BaseForm
{
    /**
     * build organization document link form
     */
    public function buildForm()
    {
        $this
            ->add('url', 'text')
            ->addSelect('format', $this->getCodeList('FileFormat', 'Organization'))
            ->addNarrative('narrative')
            ->addAddMoreButton('add_narrative', 'narrative')
            ->addCollection('category', 'Organization\CategoryCodeForm', 'category')
            ->addAddMoreButton('add_category', 'category')
            ->addCollection('language', 'Organization\LanguageCodeForm', 'language')
            ->addAddMoreButton('add_language', 'language')
            ->addCollection('document_date', 'Organization\PeriodStart')
            ->addCollection('recipient_country', 'Organization\RecipientCountryForm', 'recipient_country')
            ->addAddMoreButton('add_recipient_country', 'recipient_country')
            ->addRemoveThisButton('remove_document_link');
    }
}
