<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Hanger;
use Subjig\Report\Model\HangerType;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Model\Supply;
use Subjig\Report\Model\SupplyLine;
use Subjig\Report\Model\SupplySchedule;

class ScheduleSubjigRepositoryTest extends TestCase
{
    private \PDO $connection;
    private HangerTypeRepository $typeRepository;
    private HangerRepository $subjigRepository;
    private SupplyScheduleRepository $scheduleSubjigRepository;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private SupplyRepository $supplyRepository;
    private SupplyLineRepository $lineRepository;

    public function testSave()
    {
        $type = new HangerType();
        $type->setId('K2F');
        $type->setQty(4);
        $this->typeRepository->save($type);

        $subjig = new Hanger();
        $subjig->setId('SPDMT');
        $subjig->setHangerTypeId($type->getId());
        $subjig->setOrderNumber(1);
        $subjig->setName('Speedo');
        $subjig->setQty(4);
        $this->subjigRepository->save($subjig);

        $scheduleSubjig = new SupplySchedule();
        $scheduleSubjig->setId('2022NOV');
        $scheduleSubjig->setHangerTypeId($type->getId());
        $this->scheduleSubjigRepository->save($scheduleSubjig);

        $schedule = new ScheduleWeek();
        $schedule->setId('20221101');
        $schedule->setScheduleSupplyId($scheduleSubjig->getId());
        $schedule->setDate('2022-11-01');
        $this->scheduleWeekRepository->save($schedule);

        $supply = new Supply();
        $supply->setId('K2F20221101');
        $supply->setHangerTypeId($type->getId());
        $supply->setScheduleWeekId($schedule->getId());
        $supply->setTargetSet(700);
        $this->supplyRepository->save($supply);

        $line = new SupplyLine();
        $line->setSupplyId($supply->getId());
        $line->setHangerId($subjig->getId());
        $line->setLineA(1);
        $line->setLineB(2);
        $line->setLineC(3);
        $line->setTotal(6);
        $this->lineRepository->save($line);

        $result = 1;

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->connection = Database::getConnection('prod');
        $this->typeRepository = new HangerTypeRepository($this->connection);
        $this->subjigRepository = new HangerRepository($this->connection);
        $this->scheduleSubjigRepository = new SupplyScheduleRepository($this->connection);
        $this->scheduleWeekRepository = new ScheduleWeekRepository($this->connection);
        $this->supplyRepository = new SupplyRepository($this->connection);
        $this->lineRepository = new SupplyLineRepository($this->connection);

        $this->deleteAll();
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from supply_lines");
        $this->connection->exec("DELETE from supplies");
        $this->connection->exec("DELETE from hangers");
        $this->connection->exec("DELETE from supply_schedules");
        $this->connection->exec("DELETE from hanger_types");
    }
}
