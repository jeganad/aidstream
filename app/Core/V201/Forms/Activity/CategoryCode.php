<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

class CategoryCode extends BaseForm
{
    protected $showFieldErrors = true;

    public function buildForm()
    {
        $bool = $this->getData('optional') ? false : true;
        $this
            ->addSelect('code', $this->getCodeList('DocumentCategory', 'Activity'), trans('elementForm.code'), $this->addHelpText('Activity_DocumentLink_Category-code'), null, $bool)
            ->addRemoveThisButton('remove_category_code');
    }
}
