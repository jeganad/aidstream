<?php namespace App\Http\Controllers\Complete\Activity;

use App\Http\Controllers\Controller;
use App\Models\Organization\Organization;
use App\Services\Activity\ImportActivity;
use App\Services\FormCreator\Activity\ImportActivity as FormCreator;
use App\Services\Organization\OrganizationManager;
use App\Services\RequestManager\Activity\ImportActivity as ImportActivityRequest;

/**
 * Class ImportActivityController
 * @package App\Http\Controllers\Complete\Activity
 */
class ImportActivityController extends Controller
{
    /**
     * @var OrganizationManager
     */
    protected $organizationManager;
    /**
     * @var FormCreator
     */
    protected $formCreator;
    /**
     * @var ImportActivity
     */
    protected $importActivityManager;

    /**
     * @var Organization Id.
     */
    protected $organizationId;

    /**
     * @param ImportActivity      $importActivityManager
     * @param OrganizationManager $organizationManager
     * @param FormCreator         $formCreator
     */
    public function __construct(ImportActivity $importActivityManager, OrganizationManager $organizationManager, FormCreator $formCreator)
    {
        $this->middleware('auth');
        $this->middleware('auth.systemVersion');
        $this->organizationId        = session('org_id');
        $this->organizationManager   = $organizationManager;
        $this->formCreator           = $formCreator;
        $this->importActivityManager = $importActivityManager;
    }

    /**
     * display Import Activity form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings           = auth()->user()->organization->settings;
        $defaultFieldValues = $settings->default_field_values;

        if (!$defaultFieldValues) {
            $response = ['type' => 'warning', 'code' => ['default_values', ['name' => trans('global.activity')]]];

            return redirect('/default-values')->withResponse($response);
        }
        
        session()->forget('activities');
        $organization = $this->organizationManager->getOrganization($this->organizationId);
        if (!isset($organization->reporting_org[0])) {
            $response = ['type' => 'warning', 'code' => ['settings', ['name' => trans('global.activity')]]];

            return redirect('/settings')->withResponse($response);
        }
        $form = $this->formCreator->createForm();
        
        return view('Activity.uploader', compact('form'));
    }

    /**
     * display activity list to be imported with validation messages
     * @param ImportActivityRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listActivities(ImportActivityRequest $request)
    {
        $organization = $this->organizationManager->getOrganization($this->organizationId);
        $this->authorize('add_activity', $organization);

        if (!isset($organization->reporting_org[0])) {
            $response = ['type' => 'warning', 'code' => ['settings', ['name' => trans('global.activity')]]];

            return redirect('/settings')->withResponse($response);
        }

        $file       = request()->file('activity');
        $activities = $this->importActivityManager->getActivities($file);

        if ($activities === false) {
            return redirect()->route('import-activity.index')->withResponse(
                ['type' => 'warning', 'code' => ['message', ['message' => trans('error.header_mismatch')]]]
            );
        } elseif (!$activities) {
            return redirect()->route('import-activity.index')->withResponse(['type' => 'warning', 'code' => ['message', ['message' => trans('error.activities_not_found')]]]);
        }
        $duplicateIdentifiers = array_pop($activities);

        return view('Activity.list-activities', compact('activities', 'duplicateIdentifiers'));
    }

    /**
     * import selected activities
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importActivities()
    {
        $activities = request()->get('activities');

        if (!$activities) {
            $response = ['type' => 'warning', 'code' => ['message', ['message' => trans('success.select_one_activity')]]];

            return redirect()->back()->withResponse($response);
        } elseif (!$this->importActivityManager->importActivities($activities)) {
            $response = ['type' => 'danger', 'code' => ['activities_import_failed']];

            return redirect()->back()->withResponse($response);
        }

        $importedActivities = $this->importActivityManager->getImportedActivities();
        $response           = ['type' => 'success', 'code' => [count($importedActivities) > 1 ? 'activities_imported' : 'activity_imported', ['activities' => implode(', ', $importedActivities)]]];
        session()->forget('activities');

        return redirect()->route('activity.index')->withResponse($response);
    }
}
