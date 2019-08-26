<?php namespace App\Core\V203\Requests\Activity;

use App\Http\Requests\Request;

/**
 * Class DefaultAidType
 * @package App\Core\V201\Requests\Activity
 */
class DefaultAidType extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * get the validation rules that apply to the activity request.
     * @return array
     */
    public function rules()
    {
        return $this->getRules($this->get('default_aid_type'));
    }

    public function messages()
    {
        // $messages['default_aid_type.required'] = trans('validation.required', ['attribute' => trans('element.default_aid_type')]);

        // return $messages;
        return $this->getMessages($this->get('default_aid_type'));
    }

    /**
     * returns rules for Default Aid Type
     * @param $formFields
     * @return array|mixed
     */
    public function getRules($formFields)
    {
        $rules = [];
        foreach ($formFields as $aidtypeIndex => $aidtype) {
            $aidtypeForm                                                    = sprintf('default_aid_type.%s', $aidtypeIndex);

            $rules[sprintf('%s.default_aidtype_vocabulary', $aidtypeForm)]  = 'required';
            $vocabulary = getVal($aidtype, ['default_aidtype_vocabulary']);
            if ($vocabulary == 1) {
                $rules[sprintf('%s.default_aid_type', $aidtypeForm)] = 'required_with:' . $aidtypeForm . '.default_aidtype_vocabulary';
            } else if($vocabulary == 2) {
                $rules[sprintf('%s.earmarking_category', $aidtypeForm)] = 'required_with:' . $aidtypeForm . '.default_aidtype_vocabulary';
            } else if($vocabulary == 3) {
                $rules[sprintf('%s.default_aid_type_text', $aidtypeForm)] = 'required_with:' . $aidtypeForm. '.default_aidtype_vocabulary';
            } else if($vocabulary == 4) {
                $rules[sprintf('%s.cash_and_voucher_modalities', $aidtypeForm)] = 'required_with:'. $aidtypeForm. '.default_aidtype_vocabulary';
            }
        }

        return $rules;
    }

    /**
     * returns messages for Default Aid Type
     * @param $formFields
     * @return array|mixed
     */
    public function getMessages($formFields)
    {
        $messages = [];
        foreach ($formFields as $aidtypeIndex => $aidtype) {
            $aidtypeForm                                                    = sprintf('default_aid_type.%s', $aidtypeIndex);
            $messages[sprintf('%s.default_aidtype_vocabulary.required', $aidtypeForm)] = trans('validation.required', ['attribute' => trans('elementForm.default_aid_type')]);
            $vocabulary = getVal($aidtype, ['default_aidtype_vocabulary']);
            if ($vocabulary == 1) {
                $messages[sprintf('%s.default_aid_type.%s', $aidtypeForm, 'required_with')] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.default_aid_type_code'), 'values' => trans('elementForm.default_aid_type_vocabulary')]
                );
            } else if($vocabulary == 2) {
                $messages[sprintf('%s.earmarking_category.%s', $aidtypeForm, 'required_with')] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.default_aid_type_code'), 'values' => trans('elementForm.default_aid_type_vocabulary')]
                );
            } else if($vocabulary == 3) {
                $messages[sprintf('%s.default_aid_type_text.%s', $aidtypeForm, 'required_with')] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.default_aid_type_text'), 'values' => trans('elementForm.default_aid_type_vocabulary')]
                );
            } else if($vocabulary == 4){
                $messages[sprintf('%s.cash_and_voucher_modalities.%s', $aidtypeForm, 'required_with')] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.default_aid_type_code'), 'values' => trans('elementForm.default_aid_type_vocabulary')]
                );
            }
        }

        return $messages;
    }
}
