<?php namespace App\Services\Activity;

use App\Core\Version;
use App\Models\Activity\Activity;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Logging\Log as DbLogger;
use Illuminate\Database\Eloquent\Model;
use Psr\Log\LoggerInterface as Logger;
use Illuminate\Database\DatabaseManager;

/**
 * Class DefaultAidTypeManager
 * @package App\Services\Activity
 */
class DefaultAidTypeManager
{
    /**
     * @var Guard
     */
    protected $auth;
    /**
     * @var Version
     */
    protected $version;
    /**
     * @var DatabaseManager
     */
    protected $database;
    /**
     * @var DbLogger
     */
    protected $dbLogger;
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Version         $version
     * @param Guard           $auth
     * @param DatabaseManager $database
     * @param DbLogger        $dbLogger
     * @param Logger          $logger
     */
    public function __construct(Version $version, Guard $auth, DatabaseManager $database, DbLogger $dbLogger, Logger $logger)
    {
        $this->auth               = $auth;
        $this->dbLogger           = $dbLogger;
        $this->database           = $database;
        $this->defaultAidTypeRepo = $version->getActivityElement()->getDefaultAidType()->getRepository();
        $this->logger             = $logger;
    }

    /**
     * updates Activity Default Aid Type
     * @param array    $activityDetails
     * @param Activity $activity
     * @return bool
     */
    public function update(array $activityDetails, Activity $activity)
    {
        try {
            $this->database->beginTransaction();
            $this->defaultAidTypeRepo->update($activityDetails, $activity);
            $this->database->commit();
            $this->logger->info(
                'Activity Default Aid Type updated!',
                ['for' => $activity->default_aid_type]
            );
            $this->dbLogger->activity(
                "activity.default_aid_type",
                [
                    'activity_id'     => $activity->id,
                    'organization'    => $this->auth->user()->organization->name,
                    'organization_id' => $this->auth->user()->organization->id
                ]
            );

            return true;
        } catch (Exception $exception) {
            $this->database->rollback();
            $this->logger->error($exception, ['defaultAidType' => $activityDetails]);
        }

        return false;
    }

    /**
     * @param $id
     * @return Model
     */
    public function getDefaultAidTypeData($id)
    {
        return $this->defaultAidTypeRepo->getDefaultAidTypeData($id);
    }
}
