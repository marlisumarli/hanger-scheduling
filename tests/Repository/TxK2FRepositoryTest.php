<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\TxK2F;

class TxK2FRepositoryTest extends TestCase
{
    private TxK2FRepository $txK2FRepository;

    public function testSave()
    {
        $date = '2022-11-03';
        $category = 'K1AC';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK2F = new TxK2F();
        $txK2F->tx_k2f_id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK2F->category_id = "K1AC";
        $txK2F->tx_k2f_type = "K2F";
        $txK2F->tx_k2f_year = $currentYearOnly();
        $txK2F->tx_k2f_speedometer_a = 80;
        $txK2F->tx_k2f_speedometer_b = 80;
        $txK2F->tx_k2f_ring_speedometer = 50;
        $txK2F->tx_k2f_front_r = 123;
        $txK2F->tx_k2f_front_l = 122;
        $txK2F->tx_k2f_fender = 300;
        $txK2F->tx_k2f_front_top = 400;
        $txK2F->tx_k2f_under_rL = 220;
        $txK2F->tx_k2f_lid_pocket = 100;
        $txK2F->tx_k2f_body_rl = 500;
        $txK2F->tx_k2f_center_upper = 100;
        $txK2F->tx_k2f_rr_center = 300;
        $txK2F->tx_k2f_center = 300;
        $txK2F->tx_k2f_inner_upper = 30;
        $txK2F->tx_k2f_inner = 600;
        $txK2F->tx_k2f_date = $date;

        $this->txK2FRepository->save($txK2F);

        $result = $this->txK2FRepository->findById($txK2F->tx_k2f_id);
        self::assertNotNull($result->tx_k2f_date);
    }

    public function testUpdate()
    {
        $date = '2022-11-03';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK2F = new TxK2F();
        $txK2F->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK2F->categoryCode = "K2F-S-LN-A";
        $txK2F->type = "K2F";
        $txK2F->year = $currentYearOnly();
        $txK2F->speedometerA = 80;
        $txK2F->speedometerB = 80;
        $txK2F->ringSpeedometer = 50;
        $txK2F->frontR = 123;
        $txK2F->frontL = 122;
        $txK2F->fender = 300;
        $txK2F->frontTop = 400;
        $txK2F->underRL = 220;
        $txK2F->lidPocket = 100;
        $txK2F->bodyRL = 500;
        $txK2F->centerUpper = 100;
        $txK2F->rrCenter = 300;
        $txK2F->center = 300;
        $txK2F->innerUpper = 30;
        $txK2F->inner = 600;
        $txK2F->supplyTanggal = $date;

        $this->txK2FRepository->save($txK2F);

        $txK2F = new TxK2F();
        $txK2F->id = "20221103K2F-S-LN-A";
        $txK2F->categoryCode = "K2F-S-LN-A";
        $txK2F->supplyTanggal = "2022-10-03";
        $this->txK2FRepository->update($txK2F);

        $result = $this->txK2FRepository->findById($txK2F->id);
        self::assertNotNull($result->updatedAt);
    }

    public function testDeleteById()
    {
        $date = '2022-11-03';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK2F = new TxK2F();
        $txK2F->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK2F->categoryCode = "K2F-S-LN-A";
        $txK2F->type = "K2F";
        $txK2F->year = $currentYearOnly();
        $txK2F->speedometerA = 80;
        $txK2F->speedometerB = 80;
        $txK2F->ringSpeedometer = 50;
        $txK2F->frontR = 123;
        $txK2F->frontL = 122;
        $txK2F->fender = 300;
        $txK2F->frontTop = 400;
        $txK2F->underRL = 220;
        $txK2F->lidPocket = 100;
        $txK2F->bodyRL = 500;
        $txK2F->centerUpper = 100;
        $txK2F->rrCenter = 300;
        $txK2F->center = 300;
        $txK2F->innerUpper = 30;
        $txK2F->inner = 600;
        $txK2F->supplyTanggal = $date;

        $this->txK2FRepository->save($txK2F);

        $date = '2022-11-04';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK2F = new TxK2F();
        $txK2F->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK2F->categoryCode = "K2F-S-LN-A";
        $txK2F->type = "K2F";
        $txK2F->year = $currentYearOnly();
        $txK2F->speedometerA = 80;
        $txK2F->speedometerB = 80;
        $txK2F->ringSpeedometer = 50;
        $txK2F->frontR = 123;
        $txK2F->frontL = 122;
        $txK2F->fender = 300;
        $txK2F->frontTop = 400;
        $txK2F->underRL = 220;
        $txK2F->lidPocket = 100;
        $txK2F->bodyRL = 500;
        $txK2F->centerUpper = 100;
        $txK2F->rrCenter = 300;
        $txK2F->center = 300;
        $txK2F->innerUpper = 30;
        $txK2F->inner = 600;
        $txK2F->supplyTanggal = $date;
        $this->txK2FRepository->save($txK2F);

        $this->txK2FRepository->deleteById($txK2F->id);
        $result = $this->txK2FRepository->findById($txK2F->id);

        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->txK2FRepository = new TxK2FRepository(Database::getConnection());
        $this->txK2FRepository->deleteAll();
    }
}
