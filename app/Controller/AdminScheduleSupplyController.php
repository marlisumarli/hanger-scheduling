<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\ScheduleSupplyRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Service\ScheduleSupplyService;
use Subjig\Report\Service\ScheduleWeekService;
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


    public function __construct()
    {
        $this->scheduleSupplyRepository = new ScheduleSupplyRepository(Database::getConnection());
        $this->scheduleSupplyService = new ScheduleSupplyService($this->scheduleSupplyRepository);

        $this->scheduleWeekRepository = new ScheduleWeekRepository(Database::getConnection());
        $this->scheduleWeekService = new ScheduleWeekService($this->scheduleWeekRepository);

        $this->hangerTypeRepository = new HangerTypeRepository(Database::getConnection());

        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->supplyService = new SupplyService($this->supplyRepository);
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | ScheduleSupply',
            'allType' => $this->hangerTypeRepository->findAll(),
        ];
        View::render('Admin/ScheduleSupply/index', compact('model'));
    }

    public function create(string $id)
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
        View::render('Admin/ScheduleSupply/create', compact('model'));
    }

    public function postCreate(string $id)
    {
        $result = [];
        foreach ($this->scheduleSupplyRepository->findAll($id) as $key => $value) {
            $result[] = $this->scheduleSupplyRepository->data($value->getId());
        }

        try {
            $requestSSS = new ScheduleRequest();
            $requestSSS->hangerTypeId = $id;
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
                        $requestS->hangerTypeId = $id;
                        $requestS->scheduleSupplyId = $responseSSW->scheduleWeek->getId();
                        $this->supplyService->requestCreate($requestS);
                    }
                }
                $i++;
            }

            $model = [
                'success' => "/admin/schedule/$id/create"
            ];
            View::render('Admin/ScheduleSupply/create', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'allMonth' => $this->scheduleSupplyRepository->findAll($id),
                'allDate' => $result
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