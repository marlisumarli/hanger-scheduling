<?php

namespace Subjig\Report\Controller;

use DateTime;
use DateTimeZone;
use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\PeriodRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\SupplyScheduleRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class DataController
{
    private SupplyScheduleRepository $supplyScheduleRepository;
    private SessionService $sessionService;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private HangerRepository $hangerRepository;
    private SupplyRepository $supplyRepository;
    private SupplyLineRepository $supplyLineRepository;
    private HangerTypeRepository $hangerTypeRepository;
    private PeriodRepository $periodRepository;
    private SupplyScheduleRepository $scheduleSupplyRepository;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->supplyScheduleRepository = new SupplyScheduleRepository($connection);

        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);

        $this->hangerRepository = new HangerRepository($connection);

        $this->supplyLineRepository = new SupplyLineRepository($connection);

        $this->supplyRepository = new SupplyRepository($connection);

        $this->hangerTypeRepository = new HangerTypeRepository($connection);

        $this->periodRepository = new PeriodRepository($connection);

        $this->scheduleSupplyRepository = new SupplyScheduleRepository($connection);
    }

    public function index()
    {
        View::render('Admin/Data/SupplyData/index', [
            'Data' => 'active bg-warning',
            'Title' => "Admin | Data",
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'session' => $this->sessionService->current(),
            'hanger_types' => $this->hangerTypeRepository->findAll(),
        ]);
    }

    public function scheduleData(string $type)
    {
        View::render('Admin/Data/SupplyData/schedule-data', [
            'Data' => 'active bg-warning',
            'Title' => "Admin | Data",
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'periods' => $this->periodRepository->findAll(),
            'schedules' => $this->scheduleSupplyRepository->findAll($type),
            'schedule_weeks' => $this->scheduleWeekRepository,
            'type' => $type,
            'session' => $this->sessionService->current(),
            'dateNow' => new DateTime('now', new DateTimeZone('Asia/Jakarta'))
        ]);
    }

    public function supplyData(string $type, string $scheduleId)
    {

        if ($this->supplyScheduleRepository->findById($scheduleId) !== null) {

            $schedule = $this->supplyScheduleRepository->findById($scheduleId);

            View::render('Admin/Data/SupplyData/supply-data', [
                'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
                'Data' => 'active bg-warning',
                'Supply' => 'active bg-warning',
                'Schedule' => 'active bg-warning',
                'Title' => "Data Supply $type",
                'schedule' => $schedule,
                'schedule_weeks' => $this->scheduleWeekRepository->findScheduleSupplyId($schedule->getId()),
                'hangers' => $this->hangerRepository->findHangerTypeId($type),
                'supplies' => $this->supplyRepository,
                'supply_lines' => $this->supplyLineRepository,
                'type' => $type,
                'session' => $this->sessionService->current(),
            ]);
        } else {
            View::render('404');
        }
    }

    public function export(string $type, string $scheduleId)
    {

        View::render('Admin/Data/SupplyData/export', [
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Title' => "Export..",
            'schedule' => $this->supplyScheduleRepository->findById($scheduleId),
            'schedule_weeks' => $this->scheduleWeekRepository->findScheduleSupplyId($scheduleId),
            'hangers' => $this->hangerRepository->findHangerTypeId($type),
            'supplies' => $this->supplyRepository,
            'supply_lines' => $this->supplyLineRepository,
            'type' => $type,
            'session' => $this->sessionService->current(),
        ]);
    }
}