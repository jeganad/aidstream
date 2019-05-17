<?php namespace App\Core\V201\Requests\Activity;

use Illuminate\Support\Facades\Validator;

/**
 * Class Result
 * @package App\Core\V201\Requests\Activity
 */
class Result extends ActivityBaseRequest
{
    function __construct()
    {
        parent::__construct();
        Validator::extendImplicit(
            'year_value_narrative_validation',
            function ($attribute, $value, $parameters, $validator) {
                $narratives   = $value['comment'][0]['narrative'];
                $hasNarrative = false;
                foreach ($narratives as $narrative) {
                    if ($narrative['narrative']) {
                        $hasNarrative = true;
                        break;
                    }
                }

                if (!$hasNarrative) {
                    return true;
                }

                isset($value['year']) ?: $value['year'] = null;
                isset($value['value']) ?: $value['value'] = null;

                return ($hasNarrative && ($value['year'] || $value['value']));
            }
        );
    }

    /**
     * Get the validation rules that apply to the request.
     * prepare the error message
     * @return array
     */
    public function rules()
    {
        return $this->getRulesForResult($this->get('result'));
    }

    /**
     * get the error message
     * @return array
     */
    public function messages()
    {
        return $this->getMessagesForResult($this->get('result'));
    }

    /**
     * returns rules for result
     * @param $formFields
     * @return array|mixed
     */
    protected function getRulesForResult($formFields)
    {
        $rules = [];

        foreach ($formFields as $resultIndex => $result) {
            $resultForm                             = sprintf('result.%s', $resultIndex);
            $rules[sprintf('%s.type', $resultForm)] = 'required';
            $rules                                  = array_merge(
                $rules,
                $this->getRulesForRequiredNarrative($result['title'][0]['narrative'], sprintf('%s.title.0', $resultForm)),
                $this->getRulesForNarrative($result['description'][0]['narrative'], sprintf('%s.description.0', $resultForm)),
                $this->getRulesForIndicator($result['indicator'], $resultForm)
            );
        }

        return $rules;
    }

    /**
     * returns messages for result
     * @param $formFields
     * @return array|mixed
     */
    protected function getMessagesForResult($formFields)
    {
        $messages = [];

        foreach ($formFields as $resultIndex => $result) {
            $resultForm                                         = sprintf('result.%s', $resultIndex);
            $messages[sprintf('%s.type.required', $resultForm)] = 'Type is required.';
            $messages                                           = array_merge(
                $messages,
                $this->getMessagesForRequiredNarrative($result['title'][0]['narrative'], sprintf('%s.title.0', $resultForm)),
                $this->getMessagesForNarrative($result['description'][0]['narrative'], sprintf('%s.description.0', $resultForm)),
                $this->getMessagesForIndicator($result['indicator'], $resultForm)
            );
        }

        return $messages;
    }

    /**
     * returns rules for indicator
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getRulesForIndicator($formFields, $formBase)
    {
        $rules = [];

        foreach ($formFields as $indicatorIndex => $indicator) {
            $indicatorForm                                                        = sprintf('%s.indicator.%s', $formBase, $indicatorIndex);
            $rules[sprintf('%s.measure', $indicatorForm)]                         = 'required';
            $rules                                                                = array_merge(
                $rules,
                $this->getRulesForNarrative($indicator['title'][0]['narrative'], sprintf('%s.title.0', $indicatorForm)),
                $this->getRulesForNarrative($indicator['description'][0]['narrative'], sprintf('%s.description.0', $indicatorForm)),
                $this->getRulesForBaseline($indicator['baseline'], $indicatorForm),
                $this->getRulesForPeriod($indicator['period'], $indicatorForm, $indicator)
            );
            $rules[sprintf('%s.title.0.narrative.0.narrative', $indicatorForm)][] = 'required';
        }

        return $rules;
    }

    /**
     * returns messages for indicator
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getMessagesForIndicator($formFields, $formBase)
    {
        $messages = [];

        foreach ($formFields as $indicatorIndex => $indicator) {
            $indicatorForm                                                                  = sprintf('%s.indicator.%s', $formBase, $indicatorIndex);
            $messages[sprintf('%s.measure.required', $indicatorForm)]                       = trans('validation.required', ['attribute' => trans('elementForm.measure')]);
            $messages                                                                       = array_merge(
                $messages,
                $this->getMessagesForNarrative($indicator['title'][0]['narrative'], sprintf('%s.title.0', $indicatorForm)),
                $this->getMessagesForNarrative($indicator['description'][0]['narrative'], sprintf('%s.description.0', $indicatorForm)),
                $this->getMessagesForBaseline($indicator['baseline'], $indicatorForm),
                $this->getMessagesForPeriod($indicator['period'], $indicatorForm)
            );
            $messages[sprintf('%s.title.0.narrative.0.narrative.required', $indicatorForm)] = trans('validation.required', ['attribute' => trans('elementForm.title')]);
        }

        return $messages;
    }

    /**
     * returns rules for baseline
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */

    protected function getRulesForBaseline($formFields, $formBase)
    {
        $rules = [];

        foreach ($formFields as $baselineIndex => $baseline) {
            $baselineForm                              = sprintf('%s.baseline.%s', $formBase, $baselineIndex);
            $rules[$baselineForm]                      = 'year_value_narrative_validation:' . $baselineForm . '.comment.0.narrative';
            $rules[sprintf('%s.year', $baselineForm)]  = sprintf('required_with:%s.value|date_format:Y|digits:4', $baselineForm);
            $rules[sprintf('%s.value', $baselineForm)] = sprintf('required_with:%s.year', $baselineForm);
            $rules                                     = array_merge(
                $rules,
                $this->getRulesForNarrative($baseline['comment'][0]['narrative'], sprintf('%s.comment.0', $baselineForm))
            );
        }

        return $rules;
    }

    /**
     * returns messages for baseline
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getMessagesForBaseline($formFields, $formBase)
    {
        $messages = [];

        foreach ($formFields as $baselineIndex => $baseline) {
            $baselineForm                                                           = sprintf('%s.baseline.%s', $formBase, $baselineIndex);
            $messages[sprintf('%s.year_value_narrative_validation', $baselineForm)] = trans(
                'validation.year_value_narrative_validation',
                [
                    'year'      => trans('elementForm.year'),
                    'value'     => trans('elementForm.value'),
                    'narrative' => trans('elementForm.comment')
                ]
            );
            $messages[sprintf('%s.year.required_with', $baselineForm)] = trans(
                'validation.required_with',
                [
                    'attribute' => trans('elementForm.year'),
                    'values'    => trans('elementForm.value')
                ]
            );
            $messages[sprintf('%s.value.required_with', $baselineForm)] = trans(
                'validation.required_with',
                [
                    'attribute' => trans('elementForm.value'),
                    'values'    => trans('elementForm.year')
                ]
            );
            $messages[sprintf('%s.year.date_format', $baselineForm)]    = trans('validation.enter_valid', ['attribute' => trans('elementForm.year')]);
            $messages[sprintf('%s.year.digits', $baselineForm)]                = trans('validation.digits',['attribute' => trans('elementForm.year')]);
            $messages                                                   = array_merge(
                $messages,
                $this->getMessagesForNarrative($baseline['comment'][0]['narrative'], sprintf('%s.comment.0', $baselineForm))
            );
        }

        return $messages;
    }

    /**
     * returns rules for period
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getRulesForPeriod($formFields, $formBase)
    {
        $rules = [];

        foreach ($formFields as $periodIndex => $period) {
            $periodForm = sprintf('%s.period.%s', $formBase, $periodIndex);
            $rules      = array_merge(
                $rules,
                $this->getRulesForResultPeriodStart($period['period_start'], $periodForm, $period['period_end']),
                $this->getRulesForResultPeriodEnd($period['period_end'], $periodForm, $period['period_start']),
                $this->getRulesForTarget($period['target'], sprintf('%s.target', $periodForm)),
                $this->getRulesForTarget($period['actual'], sprintf('%s.actual', $periodForm))
            );
        }

        return $rules;
    }

    /**
     * returns messages for period
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getMessagesForPeriod($formFields, $formBase)
    {
        $messages = [];

        foreach ($formFields as $periodIndex => $period) {
            $periodForm = sprintf('%s.period.%s', $formBase, $periodIndex);
            $messages   = array_merge(
                $messages,
                $this->getMessagesForResultPeriodStart($period['period_start'], $periodForm, $period['period_end']),
                $this->getMessagesForResultPeriodEnd($period['period_end'], $periodForm, $period['period_start']),
                $this->getMessagesForTarget($period['target'], sprintf('%s.target', $periodForm)),
                $this->getMessagesForTarget($period['actual'], sprintf('%s.actual', $periodForm))
            );
        }

        return $messages;
    }

    /**
     * returns rules for target
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getRulesForTarget($formFields, $formBase)
    {
        $rules = [];
        foreach ($formFields as $targetIndex => $target) {
            $targetForm         = sprintf('%s.%s', $formBase, $targetIndex);

            $rules = array_merge(
                $rules,
                $this->getRulesForNarrative($target['comment'][0]['narrative'], sprintf('%s.comment.0', $targetForm))
            );
        }

        return $rules;
    }

    /**
     * returns messages for target
     * @param $formFields
     * @param $formBase
     * @return array|mixed
     */
    protected function getMessagesForTarget($formFields, $formBase)
    {
        $messages = [];

        foreach ($formFields as $targetIndex => $target) {
            $targetForm                                            = sprintf('%s.%s', $formBase, $targetIndex);

            $messages = array_merge(
                $messages,
                $this->getMessagesForNarrative($target['comment'][0]['narrative'], sprintf('%s.comment.0', $targetForm))
            );
        }

        return $messages;
    }

    /**
     * @param $formFields
     * @param $formBase
     * @param $periodEnd
     * @return array
     */
    protected function getRulesForResultPeriodStart($formFields, $formBase, $periodEnd)
    {
        $rules = [];
        foreach ($formFields as $periodStartKey => $periodStartVal) {
            $periodEndLocation = $formBase . '.period_end.' . $periodStartKey . '.date';
            $rules[$formBase . '.period_start.' . $periodStartKey . '.date'] = 'required';
            if ($periodEnd[$periodStartKey]['date'] != "") {
                $rules[$formBase . '.period_start.' . $periodStartKey . '.date'] = sprintf('required_with:%s|date', $periodEndLocation);
            }
        }

        return $rules;
    }

    /**
     * @param $formFields
     * @param $formBase
     * @param $periodEnd
     * @return array
     */
    protected function getMessagesForResultPeriodStart($formFields, $formBase, $periodEnd)
    {
        $messages = [];
        foreach ($formFields as $periodStartKey => $periodStartVal) {
            $messages[$formBase . '.period_start.' . $periodStartKey . '.date.required'] = trans(
                'validation.required',
                ['attribute' => trans('elementForm.period_start')]
            );
            if ($periodEnd[$periodStartKey]['date'] != "") {
                $messages[$formBase . '.period_start.' . $periodStartKey . '.date.required_with'] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.period_start'), 'values' => trans('elementForm.period_end')]
                );
            }
            $messages[$formBase . '.period_end.' . $periodStartKey . '.date.date'] = trans('validation.date', ['attribute' => trans('elementForm.period_start')]);
        }

        return $messages;
    }

    /**
     * @param $formFields
     * @param $formBase
     * @param $periodStart
     * @return array
     */
    protected function getRulesForResultPeriodEnd($formFields, $formBase, $periodStart)
    {
        $rules = [];
        foreach ($formFields as $periodEndKey => $periodEndVal) {
            $periodStartLocation = $formBase . '.period_start.' . $periodEndKey . '.date';
            $rules[$formBase . '.period_end.' . $periodEndKey . '.date'] = 'required';
            if ($periodStart[$periodEndKey]['date'] > $periodEndVal['date']) {
                $rules[$formBase. '.period_end.' . $periodEndKey . '.date'] = sprintf('required_with:%s|date|after:%s', $periodStartLocation, $formBase . '.period_start.' . $periodEndKey . '.date');
            }
        }

        return $rules;
    }

    /**
     * @param $formFields
     * @param $formBase
     * @param $periodStart
     * @return array
     */
    protected function getMessagesForResultPeriodEnd($formFields, $formBase, $periodStart)
    {
        $messages = [];
        foreach ($formFields as $periodEndKey => $periodEndVal) {
            $messages[$formBase . '.period_end.' . $periodEndKey . '.date.required'] = trans(
                'validation.required',
                ['attribute' => trans('elementForm.period_end')]
            );
            if ($periodStart[$periodEndKey]['date'] != "") {
                $messages[$formBase . '.period_end.' . $periodEndKey . '.date.required_with'] = trans(
                    'validation.required_with',
                    ['attribute' => trans('elementForm.period_end'), 'values' => trans('elementForm.period_start')]
                );
            }
            $messages[$formBase . '.period_end.' . $periodEndKey . '.date.date']  = trans('validation.date', ['attribute' => trans('elementForm.period_end')]);
            $messages[$formBase . '.period_end.' . $periodEndKey . '.date.after'] = trans(
                'validation.after',
                ['attribute' => trans('elementForm.period_end'), 'date' => trans('elementForm.period_start')]
            );
        }

        return $messages;
    }
}
