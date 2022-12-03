<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;

class AdminDataReportController
{
    private SupplyRepository $supplyRepository;
    private HangerTypeRepository $hangerTypeRepository;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private SupplyLineRepository $supplyLineRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->supplyLineRepository = new SupplyLineRepository($connection);
        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);
        $this->supplyRepository = new SupplyRepository($connection);
        $this->hangerTypeRepository = new HangerTypeRepository($connection);
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | DataReport',
            'hanger_types' => $this->hangerTypeRepository->findAll()
        ];
        View::render('Admin/DataReport/index', compact('model'));
    }

    public function supply(string $type)
    {
        $result = [];
        foreach ($this->supplyRepository->findAll($type) as $item => $value) {
            $result[] = $this->supplyLineRepository->data($value->getId());
        }
        $model = [
            'Title' => "Admin | DataReport Supply $type",
            'supplies' => $this->supplyRepository->findAll($type),
            'supply_lines' => $result,
            'type' => $type,
        ];
        View::render('Admin/DataReport/supply', compact('model'));
    }

}