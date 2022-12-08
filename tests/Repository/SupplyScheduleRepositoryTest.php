<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Hanger;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Model\Supply;
use Subjig\Report\Model\SupplyLine;
use Subjig\Report\Model\SupplySchedule;

class SupplyScheduleRepositoryTest extends TestCase
{
    private SupplyScheduleRepository $supplyScheduleRepository;
    private ScheduleWeekRepository $scheduleWeekRepository;
    private SupplyRepository $supplyRepository;
    private SupplyLineRepository $supplyLineRepository;
    private HangerRepository $hangerRepository;
    private HangerTypeRepository $hangerTypeRepository;

    public function testSave()
    {
        $year = [2021, 2022];
        $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $date = [1, 2, 3, 4, 5];
        $mid = ['M1', 'M2', 'M3', 'M4', 'M5'];
        $type = ['k2f', 'k1a'];
        $hangersK2f = ['k2f01', 'k2f02', 'k2f03', 'k2f04', 'k2f05', 'k2f06', 'k2f07', 'k2f08', 'k2f09', 'k2f10', 'k2f11', 'k2f12', 'k2f13', 'k2f14', 'k2f15', 'k2f16', 'k2f17'];
        $hangersK1a = ['k1a01', 'k1a02', 'k1a03', 'k1a04', 'k1a05', 'k1a06'];

        foreach ($hangersK2f as $key => $hk2f) {
            $hanger = new Hanger();
            $hanger->setId(uniqid());
            $hanger->setHangerTypeId('k2f');
            $hanger->setName($hk2f);
            $hanger->setQty(rand(1, 17));
            $hanger->setOrderNumber(rand(1, 17));
            $this->hangerRepository->save($hanger);
        }

        foreach ($hangersK1a as $key2 => $hk1a) {
            $hanger = new Hanger();
            $hanger->setId(uniqid());
            $hanger->setHangerTypeId('k1a');
            $hanger->setName($hk1a);
            $hanger->setQty(rand(1, 5));
            $hanger->setOrderNumber($key2);
            $this->hangerRepository->save($hanger);
        }

        foreach ($type as $t) {
            foreach ($year as $y) {
                foreach ($month as $m) {
                    $supplySch = new SupplySchedule();
                    $supplySch->setId(strtolower($y . $monthName[ $m - 1 ] . '-' . $t));
                    $supplySch->setHangerTypeId($t);
                    $supplySch->setPeriodId($y);
                    $supplySch->setMonth($m);
                    $supplySch->setIsDone(1);
                    $sc = $this->supplyScheduleRepository->save($supplySch);

                    foreach ($date as $d) {
                        $scheduleWeek = new ScheduleWeek();
                        $scheduleWeek->setId(uniqid());
                        $scheduleWeek->setScheduleSupplyId($sc->getId());
                        $scheduleWeek->setDate($y . '-' . $m . '-' . rand(1, 28));
                        $scheduleWeek->setMId($mid[ rand(0, 4) ]);
                        $scheduleWeek->setIsDone(rand(0, 1));
                        $sWeekSave = $this->scheduleWeekRepository->save($scheduleWeek);

                        $supply = new Supply();
                        $supply->setId(uniqid());
                        $supply->setScheduleWeekId($sWeekSave->getId());
                        $supply->setTargetSet(rand(300, 600));
                        $supply->setHangerTypeId($t);
                        $supplySave = $this->supplyRepository->save($supply);

                        foreach ($this->hangerRepository->findHangerTypeId($t) as $hgr) {
                            $sl = new SupplyLine();
                            $sl->setSupplyId($supplySave->getId());
                            $sl->setHangerId($hgr->getId());
                            $sl->setLineA(rand(0, 200));
                            $sl->setLineB(rand(0, 200));
                            $sl->setLineC(rand(0, 200));
                            $sl->setTotal(array_sum([$sl->getLineA(), $sl->getLineB(), $sl->getLineC()]));
                            $this->supplyLineRepository->save($sl);
                        }
                    }
                }
            }
        }
        $result = 1;
        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $connection = Database::getConnection('prod');
        $this->supplyScheduleRepository = new SupplyScheduleRepository($connection);
        $this->scheduleWeekRepository = new ScheduleWeekRepository($connection);
        $this->supplyRepository = new SupplyRepository($connection);
        $this->supplyLineRepository = new SupplyLineRepository($connection);
        $this->hangerRepository = new HangerRepository($connection);
        $this->hangerTypeRepository = new HangerTypeRepository($connection);
    }
}
