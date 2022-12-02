<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\PeriodRepository;
use Subjig\Report\Repository\ScheduleMCategoryRepository;
use Subjig\Report\Repository\ScheduleSupplyRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\ScheduleSupplyService;
use Subjig\Report\Service\ScheduleWeekService;
use Subjig\Report\Service\SessionService;
use Subjig\Report\Service\SupplyService;

class AdminScheduleSupplyController
{
    private ScheduleWeekService $scheduleWeekService;
    private ScheduleSupplyService $scheduleSupplyService;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private ScheduleSupplyRepository $scheduleSupplyRepository;
    private HangerTypeRepository $hangerTypeRepository;
    private SupplyRepository $supplyRepository;
    private SupplyService $supplyService;
    private UserDetailRepository $userDetailRepository;
    private SessionService $sessionService;
    private PeriodRepository $periodRepository;
    private ScheduleMCategoryRepository $scheduleMCategoryRepository;

    private string $username;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());

        $this->scheduleMCategoryRepository = new ScheduleMCategoryRepository(Database::getConnection());

        $this->scheduleSupplyRepository = new ScheduleSupplyRepository(Database::getConnection());
        $this->scheduleSupplyService = new ScheduleSupplyService($this->scheduleSupplyRepository);

        $this->scheduleWeekRepository = new ScheduleWeekRepository(Database::getConnection());
        $this->scheduleWeekService = new ScheduleWeekService($this->scheduleWeekRepository);

        $this->hangerTypeRepository = new HangerTypeRepository(Database::getConnection());

        $this->periodRepository = new PeriodRepository(Database::getConnection());

        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->supplyService = new SupplyService($this->supplyRepository);
        $this->username = $this->sessionService->current()->getUsername();
    }

    public function index()
    {
        $model = [
            'fullName' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
            'Schedule' => 'active bg-warning',
            'title' => 'Admin | Schedule',
            'allType' => $this->hangerTypeRepository->findAll(),
        ];
        View::render('Admin/ScheduleSupply/index', compact('model'));
    }

    public function create(string $type)
    {
        $result = [];
        foreach ($this->scheduleSupplyRepository->findAll($type) as $key => $value) {
            $result[] = $this->scheduleWeekRepository->data($value->getId());
        }

        $model = [
            'fullName' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
            'Schedule' => 'active bg-warning',
            'title' => "Admin | Schedule $type",
            'allMCategory' => $this->scheduleMCategoryRepository->findAll(),
            'allPeriod' => $this->periodRepository->findAll(),
            'allMonth' => $this->scheduleSupplyRepository->findAll($type),
            'allDate' => $result,
        ];
        View::render('Admin/ScheduleSupply/create', compact('model'));
    }

    public function postCreate(string $type)
    {
        $result = [];
        foreach ($this->scheduleSupplyRepository->findAll($type) as $key => $value) {
            $result[] = $this->scheduleWeekRepository->data($value->getId());
        }

        try {
            $requestSSS = new ScheduleRequest();
            $requestSSS->hangerTypeId = $type;
            $responseSSS = $this->scheduleSupplyService->requestCreate($requestSSS);

            $i = 1;
            while ($i <= count($_POST)) {
                if ($_POST["date-m$i"]) {
                    for ($j = 0; $j < count($_POST["date-m$i"]); $j++) {
                        $requestSSW = new ScheduleRequest();
                        $requestSSW->supplyScheduleId = $responseSSS->supplySchedule->getId();
                        $requestSSW->scheduleDate = $_POST["date-m$i"][ $j ];
                        $requestSSW->isImplemented = 0;
                        $requestSSW->mId = "M$i";
                        $responseSSW = $this->scheduleWeekService->requestCreate($requestSSW);

                        $requestS = new SupplyRequest();
                        $requestS->hangerTypeId = $type;
                        $requestS->scheduleSupplyId = $responseSSW->scheduleWeek->getId();
                        $this->supplyService->requestCreate($requestS);
                    }
                }
                $i++;
            }

            $model = [
                'success' => "/admin/schedule/$type/create"
            ];
            View::render('Admin/ScheduleSupply/create', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'fullName' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
                'Schedule' => 'active bg-warning',
                'title' => "Admin | Schedule $type",
                'allMCategory' => $this->scheduleMCategoryRepository->findAll(),
                'allPeriod' => $this->periodRepository->findAll(),
                'allMonth' => $this->scheduleSupplyRepository->findAll($type),
                'allDate' => $result,
            ];
            View::render('Admin/ScheduleSupply/create', compact('model'));
        }
    }

    public function delete(string $id)
    {
        $hTI = $this->scheduleSupplyRepository->findById($id)->getHangerTypeId();
        $this->scheduleSupplyRepository->deleteById($id);
        $model = [
            'success' => "/admin/schedule/$hTI/create"
        ];
        View::render('Admin/ScheduleSupply/delete', compact('model'));
    }
}