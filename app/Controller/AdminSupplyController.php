<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\PeriodRepository;
use Subjig\Report\Repository\ScheduleMCategoryRepository;
use Subjig\Report\Repository\ScheduleSupplyRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\ScheduleWeekService;
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
    private ScheduleWeekService $scheduleWeekService;
    private ScheduleMCategoryRepository $scheduleMCategoryRepository;
    private PeriodRepository $periodRepository;
    private ScheduleSupplyRepository $scheduleSupplyRepository;
    private UserDetailRepository $userDetailRepository;
    private SessionService $sessionService;
    private string $username;


    public function __construct()
    {
        $connection = Database::getConnection();

        $this->hangerTypeRepository = new HangerTypeRepository($connection);

        $this->hangerRepository = new HangerRepository($connection);

        $this->supplyRepository = new SupplyRepository($connection);
        $this->supplyService = new SupplyService($this->supplyRepository);

        $this->supplyLineRepository = new SupplyLineRepository($connection);
        $this->supplyLineService = new SupplyLineService($this->supplyLineRepository);

        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);
        $this->scheduleWeekService = new ScheduleWeekService($this->scheduleWeekRepository);

        $this->scheduleMCategoryRepository = new ScheduleMCategoryRepository($connection);

        $this->periodRepository = new PeriodRepository(Database::getConnection());

        $this->scheduleSupplyRepository = new ScheduleSupplyRepository($connection);

        $this->userDetailRepository = new UserDetailRepository($connection);

        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
        $this->username = $this->sessionService->current()->getUsername();
    }


    public function index()
    {
        $model = [
            'Supply' => 'active bg-warning',
            'Title' => 'Admin | Supply',
            'full_name' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
            'hanger_types' => $this->hangerTypeRepository->findAll(),
        ];
        View::render('Admin/ScheduleSupply/Supply/index', compact('model'));
    }

    public function schedule(string $type)
    {

        $result = [];
        foreach ($this->scheduleSupplyRepository->findAll($type) as $key => $value) {
            $result[] = $this->scheduleWeekRepository->data($value->getId());
        }

        $model = [
            'full_name' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'schedule_m_categories' => $this->scheduleMCategoryRepository->findAll(),
            'periods' => $this->periodRepository->findAll(),
            'schedules' => $this->scheduleSupplyRepository->findAll($type),
            'schedule_weeks' => ($result),
            'type' => $type
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/index', compact('model'));
    }

    public function create(string $type, string $supplyId)
    {
        $model = [
            'full_name' => Util::nameSplitter($this->userDetailRepository->findByUsername($this->username)->getFullName()),
            'Supply' => 'active bg-warning',
            'Title' => "Admin | Supply $type",
            'schedule_week' => $this->scheduleWeekRepository->findById($this->supplyRepository->findById($supplyId)->getScheduleWeekId()),
            'hangers' => $this->hangerRepository->data($type),
            'type' => $type,
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));
    }

    public function postCreate(string $type, string $supplyId)
    {
        $hangers = $this->hangerRepository->data($type);
        $supply = $this->supplyRepository->findById($supplyId);
        $requestUpdateSupply = new SupplyRequest();
        $requestUpdateSupply->supplyId = $supply->getId();
        $requestUpdateSupply->supplyTarget = $_POST['target'];
        $this->supplyService->requestUpdate($requestUpdateSupply);

        foreach ($hangers as $key => $hanger) {
            $createLine = new SupplyRequest();
            $createLine->supplyId = $supply->getId();
            $createLine->hangerId = $hanger->getHangerId();
            $createLine->lineA = $_POST['lnA'][ $key ];
            $createLine->lineB = $_POST['lnB'][ $key ];
            $createLine->lineC = $_POST['lnC'][ $key ];
            $this->supplyLineService->requestCreate($createLine);
        }

        $updateSW = new ScheduleWeek();
        $updateSW->setId($supply->getScheduleWeekId());
        $updateSW->setIsImplemented(1);
        $this->scheduleWeekRepository->update($updateSW);

        $model = [
            'Title' => "Admin | Supply $type",
            'schedule_week' => $this->scheduleWeekRepository->findById($this->supplyRepository->findById($supplyId)->getScheduleWeekId()),
            'success' => "/admin/supply/$type"
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));
    }

    public function update(string $type, string $id)
    {
        $model = [
            'title' => "Admin | Update Supply $id",
            'idSupply' => $this->supplyRepository->findById($id),
            'allSupply' => $this->supplyRepository->allSupplyLine($id),
            'back' => $type
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/update', compact('model'));
    }

    public function postUpdate(string $type, string $id)
    {
        $allSupply = $this->supplyRepository->allSupplyLine($id);
        $date = $_POST['dateUpdate'];

        try {
            $updateSup = new SupplyRequest();
            $updateSup->supplyId = $id;
            $updateSup->supplyDate = $date;
            $updateSup->supplyTarget = $_POST['target'];
            $this->supplyService->requestUpdate($updateSup);

            foreach ($allSupply as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->lineId = $value->getSupplyLineId();
                $createLine->jumlahLineA = $_POST['lnA'][ $key ];
                $createLine->jumlahLineB = $_POST['lnB'][ $key ];
                $createLine->jumlahLineC = $_POST['lnC'][ $key ];
                $createLine->supplyTarget = $updateSup->supplyTarget;
                $this->lineService->requestUpdate($createLine);
            }
            $model = [
                'title' => "Admin | Update Supply $id",
                'success' => "/admin/supply/$type/$id/update",
                'idSupply' => $this->supplyRepository->findById($id),
                'allSupply' => $this->supplyRepository->allSupplyLine($id)
            ];
            View::render('Admin/ScheduleSupply/Supply/Hanger/update', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'title' => "Admin | $id",
            ];
            View::render('Admin/ScheduleSupply/Supply/Hanger/update', compact('model'));
        }
    }

    public function delete(string $type, string $id)
    {
        $request = new SupplyRequest();
        $request->supplyId = $id;
        $this->supplyService->requestDelete($request);

        $model = [
            'success' => "/admin/laporan/$type/supply"
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/delete', compact('model'));
    }
}