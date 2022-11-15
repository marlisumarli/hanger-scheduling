<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\K2F;
use Subjig\Report\Entity\Line;
use Subjig\Report\Entity\Supply;

class LineRepositoryTest extends TestCase
{
    private SupplyRepository $supplyRepository;
    private LineRepository $lineRepository;
    private K2FRepository $k2FRepository;

    public function testSave()
    {
        $k2f = new K2F();
        $k2f->id = 1;
        $k2f->k2f_id = 'K2FSA';
        $k2f->k2f_name = 'Speedometer A';
        $k2f->k2f_qty = 4;
        $this->k2FRepository->save($k2f);
        $type = 'K2F';
        $date = '2022-11-12';
        $supply = new Supply();
        $supply->supply_id = str_replace(array("-", ":", "/"), '', $date) . $type;
        $supply->supply_date = $date;
        $this->supplyRepository->save($supply);
        $this->supplyRepository->findById($supply->supply_id);
        $line = new Line();
        $line->supply_id = $supply->supply_id;
        $line->subjig_id = $k2f->k2f_id;
        $line->jumlah_line_a = 50;
        $line->jumlah_line_b = 50;
        $line->jumlah_line_c = 0;
        $line->total = $line->jumlah_line_a + $line->jumlah_line_b + $line->jumlah_line_c;
        $this->lineRepository->save($line);

        $line = new Line();
        $line->supply_id = $supply->supply_id;
        $line->subjig_id = $k2f->k2f_id;
        $line->jumlah_line_a = 500;
        $line->jumlah_line_b = 50;
        $line->jumlah_line_c = 0;
        $line->total = $line->jumlah_line_a + $line->jumlah_line_b + $line->jumlah_line_c;
        $line->id = 27;
        $this->lineRepository->update($line);

        $result = $this->lineRepository->findById(7);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->lineRepository = new LineRepository(Database::getConnection());
        $this->k2FRepository = new K2FRepository(Database::getConnection());

        $this->supplyRepository->deleteAll();
        $this->k2FRepository->deleteAll();
    }
}
