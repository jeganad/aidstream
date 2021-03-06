<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Services\Activity\ActivityManager;
use App\Services\Activity\RecipientRegionManager;
use App\Services\Activity\TransactionManager;
use App\Services\FormCreator\Activity\RecipientRegion as RecipientRegionForm;
use App\Services\RequestManager\Activity\RecipientRegion as RecipientRegionRequestManager;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Gate;

class RecipientRegionController extends Controller
{
    /**
     * @var ActivityManager
     */
    protected $activityManager;

    /**
     * @var RecipientRegionForm
     */
    protected $recipientRegionForm;

    /**
     * @var RecipientRegionManager
     */
    protected $recipientRegionManager;

    /**
     * @var TransactionManager
     */
    protected $transactionManager;

    /**
     * @param RecipientRegionManager $recipientRegionManager
     * @param RecipientRegionForm    $recipientRegionForm
     * @param ActivityManager        $activityManager
     * @param TransactionManager     $transactionManager
     */
    function __construct(
        RecipientRegionManager $recipientRegionManager,
        RecipientRegionForm $recipientRegionForm,
        ActivityManager $activityManager,
        TransactionManager $transactionManager
    ) {
        $this->middleware('auth');
        $this->activityManager        = $activityManager;
        $this->recipientRegionForm    = $recipientRegionForm;
        $this->recipientRegionManager = $recipientRegionManager;
        $this->transactionManager     = $transactionManager;
    }

    /**
     * returns the activity recipient region edit form
     * @param $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }

        $recipientRegion = $this->recipientRegionManager->getRecipientRegionData($id);
        $activityData    = $this->activityManager->getActivityData($id);
        $form            = $this->recipientRegionForm->editForm($recipientRegion, $id);

        return view(
            'Activity.recipientRegion.edit',
            compact('form', 'activityData', 'id')
        );
    }

    /**
     * updates activity recipient region
     * @param                               $id
     * @param Request                       $request
     * @param RecipientRegionRequestManager $recipientRegionRequestManager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, RecipientRegionRequestManager $recipientRegionRequestManager)
    {
        $activityData = $this->activityManager->getActivityData($id);

        if (Gate::denies('ownership', $activityData)) {
            return redirect()->back()->withResponse($this->getNoPrivilegesMessage());
        }

        $this->authorizeByRequestType($activityData, 'recipient_region');
        $activityTransactions = $this->transactionManager->getTransactions($id);
        $count                = 0;
        if ($activityTransactions) {
            foreach ($activityTransactions as $transactions) {
                $transactionDetail = $transactions->transaction;
                removeEmptyValues($transactionDetail);
                if (!Empty($transactionDetail['recipient_country']) || !Empty($transactionDetail['recipient_region'])) {
                    $count ++;
                }
            }
        }

        if ($count > 0) {
            $response = [
                'type' => 'warning',
                'code' => ['message', ['message' => trans('error.cannot_save_recipient_country_and_region')]]
            ];

            return redirect()->back()->withInput()->withResponse($response);
        }
        $recipientRegions = $request->all();
        foreach ($recipientRegions['recipient_region'] as &$recipientRegion) {
            ($recipientRegion['region_vocabulary'] != '') ?: $recipientRegion['region_vocabulary'] = '1';
        }
        if ($this->recipientRegionManager->update($recipientRegions, $activityData)) {
            $this->activityManager->resetActivityWorkflow($id);
            $response = ['type' => 'success', 'code' => ['updated', ['name' => trans('element.recipient_region')]]];

            return redirect()->to(sprintf('/activity/%s', $id))->withResponse($response);
        }
        $response = ['type' => 'danger', 'code' => ['update_failed', ['name' => trans('element.recipient_region')]]];

        return redirect()->back()->withInput()->withResponse($response);
    }
}
