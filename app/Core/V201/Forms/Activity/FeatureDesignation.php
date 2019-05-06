<?php namespace App\Core\V201\Forms\Activity;

use App\Core\Form\BaseForm;

/**
 * Class FeatureDesignation
 * @package App\Core\V201\Forms\Activity
 */
class FeatureDesignation extends BaseForm
{
    protected $showFieldErrors = true;

    /**
     * builds feature designation form
     */
    public function buildForm()
    {
        $this->addSelect('code', $this->getCodeList('LocationType', 'Activity'), trans('elementForm.code'), $this->addHelpText('Activity_Location_FeatureDesignation-code'));
    }
}
