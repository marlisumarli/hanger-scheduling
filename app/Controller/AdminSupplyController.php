<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Model\SupplySchedule;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\PeriodRepository;
use Subjig\Report\Repository\ScheduleMCategoryRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\SupplyScheduleRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;
use Subjig\Report\Service\SupplyLineService;
use Subjig\Report\Service\SupplyService;


class AdminSupplyController
{
    private HangerTypeRepository $hangerTypeRepository;
    private HangerRepository $hangerRepository;
    private SupplyService $supplyService;
    private SupplyRepository $supplyRepository;
    private SupplyLineService $supplyLineService;
    private SupplyLineRepository $supplyLineRepository;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private ScheduleMCategoryRepository $scheduleMCategoryRepository;
    private PeriodRepository $periodRepository;
    private SupplyScheduleRepository $scheduleSupplyRepository;
    private SessionService $sessionService;
    private string $username;


    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->hangerTypeRepository = new HangerTypeRepository($connection);

        $this->hangerRepository = new HangerRepository($connection);

        $this->supplyRepository = new SupplyRepository($connection);
        $this->supplyService = new SupplyService($this->supplyRepository);

        $this->supplyLineRepository = new SupplyLineRepository($connection);
        $this->supplyLineService = new SupplyLineService($this->supplyLineRepository);

        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);

        $this->scheduleMCategoryRepository = new ScheduleMCategoryRepository($connection);

        $this->periodRepository = new PeriodRepository(Database::getConnection());

        $this->scheduleSupplyRepository = new SupplyScheduleRepository($connection);

    }

    public function index()
    {
        $model = [
            'Supply' => 'active bg-warning',
            'Title' => 'Admin | Supply',
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'hanger_types' => $this->hangerTypeRepository->findAll(),
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/index', compact('model'));
    }

    public function schedule(string $type)
    {
        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'schedule_m_categories' => $this->scheduleMCategoryRepository->findAll(),
            'periods' => $this->periodRepository->findAll(),
            'schedules' => $this->scheduleSupplyRepository->findAll($type),
            'schedule_weeks' => $this->scheduleWeekRepository,
            'supplies' => $this->supplyRepository,
            'type' => $type,
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/index', compact('model'));
    }

    public function dataReport(string $type, string $scheduleId)
    {
        $schedule = $this->scheduleSupplyRepository->findById($scheduleId);

        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'schedule' => $schedule,
            'schedule_weeks' => $this->scheduleWeekRepository->findScheduleSupplyId($schedule->getId()),
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'supplies' => $this->supplyRepository,
            'supply_lines' => $this->supplyLineRepository,
            'type' => $type,
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/data-report', compact('model'));
    }

    public function create(string $type, string $scheduleWeekId, string $supplyId,)
    {
        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'schedule_week' => $this->scheduleWeekRepository->findById($scheduleWeekId),
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'type' => $type,
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));
    }

    public function postCreate(string $type, string $scheduleWeekId, string $supplyId)
    {
        $hangers = $this->hangerRepository->findHangerTypeId($type);

        $requestUpdateSupply = new SupplyRequest();
        $requestUpdateSupply->supplyId = $supplyId;
        $requestUpdateSupply->supplyTarget = $_POST['target'];
        $this->supplyService->requestUpdate($requestUpdateSupply);

        foreach ($hangers as $key => $hanger) {
            $createLine = new SupplyRequest();
            $createLine->supplyId = $supplyId;
            $createLine->hangerId = $hanger->getId();
            $createLine->lineA = ($_POST['lnA'][ $key ] != '' ? $_POST['lnA'][ $key ] : 0);
            $createLine->lineB = ($_POST['lnB'][ $key ] != '' ? $_POST['lnB'][ $key ] : 0);
            $createLine->lineC = ($_POST['lnC'][ $key ] != '' ? $_POST['lnC'][ $key ] : 0);
            $this->supplyLineService->requestCreate($createLine);
        }

        $schWeek = new ScheduleWeek();
        $schWeek->setId($scheduleWeekId);
        $schWeek->setIsDone(1);
        $updateSchW = $this->scheduleWeekRepository->findById($this->scheduleWeekRepository->update($schWeek)->getId());

        $supplySch = new SupplySchedule();
        $supplySch->setId($updateSchW->getScheduleSupplyId());
        $this->scheduleSupplyRepository->update($supplySch);

        $model = [
            'Title' => "Admin | Supply $type",
            'schedule_week' => $this->scheduleWeekRepository->findById($scheduleWeekId),
            'success' => "/admin/supply/$type",
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));

        exit();
    }

    public function view(string $type, string $scheduleWeekId, string $supplyId)
    {

        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'supply' => $this->supplyRepository->findById($supplyId),
            'supply_lines' => $this->supplyLineRepository->findSupplyId($supplyId),
            'schedule_week' => $this->scheduleWeekRepository->findById($scheduleWeekId)->getDate(),
            'type' => $type,
            'schedule' => $scheduleWeekId,
            'supplyId' => $supplyId,
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/view', compact('model'));
    }

    public function update(string $type, string $scheduleWeekId, string $supplyId)
    {

        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'supply' => $this->supplyRepository->findById($supplyId),
            'supply_lines' => $this->supplyLineRepository->findSupplyId($supplyId),
            'schedule_week' => $this->scheduleWeekRepository->findById($scheduleWeekId)->getDate(),
            'type' => $type,
            'schedule' => $scheduleWeekId,
            'supplyId' => $supplyId,
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/update', compact('model'));
    }

    public function postUpdate(string $type, string $scheduleWeekId, string $supplyId)
    {
        $supply_lines = $this->supplyLineRepository->findSupplyId($supplyId);
        $hangers = $this->hangerRepository->findHangerTypeId($type);
        $supply = $this->supplyRepository->findById($supplyId);

        $request = new SupplyRequest();
        $request->supplyId = $supply->getId();
        $request->supplyTarget = $_POST['target'];
        $this->supplyService->requestUpdate($request);

        foreach ($hangers as $hanger) {
            foreach ($supply_lines as $supplyLine) {
                if ($supplyLine->gethangerId() == $hanger->getId() && $supplyLine->getSupplyId() == $supply->getId()) {
                    $request = new SupplyRequest();
                    $request->supplyLineId = $supplyLine->getId();
                    $request->lineA = $_POST[ "lnA_" . $supplyLine->getId() ];
                    $request->lineB = $_POST[ "lnB_" . $supplyLine->getId() ];
                    $request->lineC = $_POST[ "lnC_" . $supplyLine->getId() ];
                    $this->supplyLineService->requestUpdate($request);
                }
            }
        }
        $model = [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'supply' => $this->supplyRepository->findById($supplyId),
            'supply_lines' => $this->supplyLineRepository->findSupplyId($supplyId),
            'schedule_week' => $this->scheduleWeekRepository->findById($scheduleWeekId)->getDate(),
            'type' => $type,
            'schedule' => $scheduleWeekId,
            'supplyId' => $supplyId,
            'success' => 'Berhasil Diubah',
            'session' => $this->sessionService->current(),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/update', compact('model'));

        exit();
    }
}