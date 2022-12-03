<?php

namespace Subjig\Report\Service;

use DateTime;
use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SupplyScheduleRepository;

class ScheduleSubjigServiceTest extends TestCase
{
    private SupplyScheduleService $scheduleSubjigService;
    private ScheduleWeekService $scheduleService;
    private \PDO $connection;

    public function testCreate()
    {
        $date = new DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $year = $date->format('Y');
        $month = $date->format('F');

        $request = new ScheduleRequest();
        $request->scheduleSubjigId = $year . strtoupper($month);
        $request->typeId = "K2F";
        $request->month = $month;
        $response = $this->scheduleSubjigService->requestCreate($request);

        $request2 = new ScheduleRequest();
        $request2->scheduleSubjigIdOnSchedule = $request->scheduleSubjigId;
        $request2->tanggal = '2022-11-25';
        $this->scheduleService->requestCreate($request2);

        $request3 = new ScheduleRequest();
        $request3->scheduleId = 20;
        $request3->isImplemented = 0;
        $this->scheduleService->requestUpdate($request3);

        self::assertNotNull($response);
    }

    protected function setUp(): void
    {
        $scheduleSubjigRepo = new SupplyScheduleRepository(Database::getConnection('prod'));
        $scheduleRepo = new ScheduleWeekRepository(Database::getConnection());
        $this->scheduleService = new ScheduleWeekService($scheduleRepo);
        $this->scheduleSubjigService = new SupplyScheduleService($scheduleSubjigRepo);
        $this->connection = Database::getConnection('prod');

        $this->deleteAll();
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from schedules_subjig");

    }
}
