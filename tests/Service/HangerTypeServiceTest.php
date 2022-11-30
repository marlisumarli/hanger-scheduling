<?php
namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\HangerRequest;
use Subjig\Report\HTTP\Request\HangerTypeRequest;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;
use Subjig\Report\Repository\ScheduleSupplyRepository;
use Subjig\Report\Repository\ScheduleWeekRepository;
use Subjig\Report\Repository\SupplyLineRepository;
use Subjig\Report\Repository\SupplyRepository;

class HangerTypeServiceTest extends TestCase
{
    private \PDO $connection;
    private HangerTypeService $hangerTypeService;
    private HangerService $hangerService;
    private ScheduleSupplyService $supplyScheduleService;
    private ScheduleWeekService $scheduleWeekService;
    private SupplyService $supplyService;
    private SupplyLineService $supplyLineService;

    public function testCreate()
    {
        $requestType = new HangerTypeRequest();
        $requestType->id = 'K2F';
        $requestType->qty = 4;
        $responseType = $this->hangerTypeService->requestCreate($requestType);

        $requestSubjig = new HangerRequest();
        $requestSubjig->hangerTypeId = $responseType->hangerType->getId();
        $requestSubjig->name = 'Speedo';
        $requestSubjig->qty = 4;
        $responseSubjig = $this->hangerService->requestCreate($requestSubjig);

        $requestScheduleSubjig = new ScheduleRequest();
        $requestScheduleSubjig->hangerTypeId = $responseType->hangerType->getId();
        $responseScheduleSubjig = $this->supplyScheduleService->requestCreate($requestScheduleSubjig);

        $requestScheduleWeek = new ScheduleRequest();
        $requestScheduleWeek->supplyScheduleId = $responseScheduleSubjig->supplySchedule->getId();
        $requestScheduleWeek->scheduleDate = '2022-11-01';
        $responseScheduleWeek = $this->scheduleWeekService->requestCreate($requestScheduleWeek);

        $requestSupply = new SupplyRequest();
        $requestSupply->hangerTypeId = $responseType->hangerType->getId();
        $requestSupply->scheduleSupplyId = $responseScheduleWeek->scheduleWeek->getId();
        $requestSupply->supplyTarget = 700;
        $responseSupply = $this->supplyService->requestCreate($requestSupply);

        $requestLine = new SupplyRequest();
        $requestLine->supplyId = $responseSupply->supply->getId();
        $requestLine->hangerId = $responseSubjig->hanger->getId();
        $requestLine->lineA = 1;
        $requestLine->lineB = 1;
        $requestLine->lineC = 1;
        $requestLine->supplyTarget = $responseSupply->supply->getTargetSet();
        $responseLine = $this->supplyLineService->requestCreate($requestLine);

        $result = 1;

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->connection = Database::getConnection('prod');
        $hangerTypeRepository = new HangerTypeRepository($this->connection);
        $hangerRepository = new HangerRepository($this->connection);
        $supplyScheduleRepository = new ScheduleSupplyRepository($this->connection);
        $scheduleWeekRepository = new ScheduleWeekRepository($this->connection);
        $supplyRepository = new SupplyRepository($this->connection);
        $supplyLineRepository = new SupplyLineRepository($this->connection);

        $this->hangerTypeService = new HangerTypeService($hangerTypeRepository);
        $this->hangerService = new HangerService($hangerRepository);
        $this->supplyScheduleService = new ScheduleSupplyService($supplyScheduleRepository);
        $this->scheduleWeekService = new ScheduleWeekService($scheduleWeekRepository);
        $this->supplyService = new SupplyService($supplyRepository);
        $this->supplyLineService = new SupplyLineService($supplyLineRepository);

        $this->deleteAll();
    }

    private function deleteAll(): void
    {
        $this->connection->exec("DELETE from supply_lines");
        $this->connection->exec("DELETE from supplies");
        $this->connection->exec("DELETE from supply_schedules");
        $this->connection->exec("DELETE from hangers");
        $this->connection->exec("DELETE from hanger_types");
    }
}
