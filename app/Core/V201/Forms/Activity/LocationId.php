<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class LocationId
 * @package App\Core\V201\Forms\Activity
 */
class LocationId extends BaseForm
{
    protected $showFieldErrors = true;

    /**
     * builds location id form
     */
    public function buildForm()
    {
        $this
            ->addSelect('vocabulary', $this->getCodeList('GeographicVocabulary', 'Activity'), trans('elementForm.vocabulary'), $this->addHelpText('Activity_Location_LocationId-vocabulary'))
            ->add('code', 'text', ['label' => trans('elementForm.code'), 'help_block' => $this->addHelpText('Activity_Location_LocationId-code')])
            ->addRemoveThisButton('remove');
    }
}
