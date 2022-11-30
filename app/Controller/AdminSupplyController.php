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
    private HangerTypeRepository $typeRepository;
    private HangerRepository $hangerRepository;
    private SupplyService $supplyService;
    private SupplyRepository $supplyRepository;
    private SupplyLineService $supplyLineService;
    private SupplyLineRepository $supplyLineRepository;
    private SessionService $sessionService;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private ScheduleWeekService $scheduleWeekService;
    private ScheduleSupplyRepository $scheduleSupplyRepository;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->scheduleSupplyRepository = new ScheduleSupplyRepository(Database::getConnection());

        $this->typeRepository = new HangerTypeRepository(Database::getConnection());
        $this->hangerRepository = new HangerRepository(Database::getConnection());

        $this->supplyLineRepository = new SupplyLineRepository(Database::getConnection());
        $this->supplyLineService = new SupplyLineService($this->supplyLineRepository);

        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->supplyService = new SupplyService($this->supplyRepository);

        $this->scheduleWeekRepository = new ScheduleWeekRepository(Database::getConnection());
        $this->scheduleWeekService = new ScheduleWeekService($this->scheduleWeekRepository);
    }

    public function index()
    {
        $fullName = new UserDetailRepository(Database::getConnection());
        $model = [
            'title' => 'Admin | Supply',
            'allType' => $this->typeRepository->findAll(),
            'supply' => 'active bg-warning',
            'fullName' => Util::nameSplitter($fullName->findByUsername($this->sessionService->current()->getUsername())->getFullName()),
        ];
        View::render('Admin/ScheduleSupply/Supply/index', compact('model'));
    }

    public function schedule(string $id)
    {

        $result = [];
        foreach ($this->scheduleSupplyRepository->findAll($id) as $key => $value) {
            $result[] = $this->scheduleSupplyRepository->data($value->getId());
        }

        $model = [
            'title' => "Admin | ScheduleSupply $id",
            'allMonth' => $this->scheduleSupplyRepository->findAll($id),
            'allDate' => $result
        ];
        // TODO encan di SupplyController
//        $model = [
//            'title' => "Admin | Supply $id",
//            'allSchedule' => $this->scheduleWeekRepository->data($id),
//            'id' => $id
//        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/index', compact('model'));
    }

    public function create(string $id)
    {
        $model = [
            'title' => "Admin | Supply $id",
            'allSubjig' => $this->hangerRepository->data($id),
        ];
        View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));
    }

    public function postCreate(string $id, string $supplyId)
    {
        $allSubjig = $this->hangerRepository->data($id);
        $supply = $this->supplyRepository->findById($supplyId);


        try {
            $requestUpdateSupply = new SupplyRequest();
            $requestUpdateSupply->supplyId = $supplyId;
            $requestUpdateSupply->supplyTarget = $_POST['target'];
            $this->supplyService->requestUpdate($requestUpdateSupply);

            foreach ($allSubjig as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->supplyId = $supplyId;
                $createLine->hangerId = $value->getHangerId();
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
                'title' => "Admin | Supply $id",
                'success' => "/admin/supply/$id"
            ];
            View::render('Admin/ScheduleSupply/Supply/Hanger/create', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Supply K2F',
                'error' => $exception->getMessage(),
                'allSubjig' => $this->hangerRepository->data($id),
            ];
            View::render('Admin/ScheduleSupply/Supply/Hanger/index', compact('model'));
        }
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