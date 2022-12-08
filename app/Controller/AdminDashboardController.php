<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\Util;
use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\SupplyScheduleRepository;
use Subjig\Report\Repository\UserRepository;
use Subjig\Report\Service\SessionService;

class AdminDashboardController
{
    private SessionService $sessionService;
    private SupplyScheduleRepository $scheduleSupplyRepository;
    private HangerTypeRepository $hangerTypeRepository;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private SupplyLineRepository $supplyLineRepository;
    private HangerRepository $hangerRepository;
    private SupplyRepository $supplyRepository;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);

        $this->scheduleSupplyRepository = new SupplyScheduleRepository($connection);

        $this->hangerTypeRepository = new HangerTypeRepository($connection);

        $this->hangerRepository = new HangerRepository($connection);

        $this->supplyRepository = new SupplyRepository($connection);

        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);

        $this->supplyLineRepository = new SupplyLineRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function index()
    {
        View::render('Admin/Dashboard/index', [
            'Title' => 'Admin | Dashboard',
            'full_name' => Util::nameSplitter($this->sessionService->current()->getFullName()),
            'Dashboard' => 'active bg-warning',
            'session' => $this->sessionService->current(),
            'hanger_types' => $this->hangerTypeRepository->findAll(),
            'supply_schedule' => $this->scheduleSupplyRepository,
            'schedule_weeks' => $this->scheduleWeekRepository,
            'supply_lines' => $this->supplyLineRepository,
            'hangers' => $this->hangerRepository,
            'supplies' => $this->supplyRepository,
        ]);
    }

    public function direct()
    {
        View::redirect('/admin/dashboard');
    }
}