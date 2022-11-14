<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\SupplyRequest;
use Subjig\Report\Repository\LineRepository;
use Subjig\Report\Repository\SupplyRepository;
use function PHPUnit\Framework\assertNotNull;

class SupplyServiceTest extends TestCase
{
    private SupplyService $supplyService;
    private LineService $lineService;

    public function testRequestCreate()
    {
        $date = '2022-11-12';
        $type = 'K2F';

        $createSup = new SupplyRequest();
        $createSup->supplyId = str_replace(array("-", ":", "/"), '', $date) . $type;
        $createSup->supplyDate = $date;
        $response = $this->supplyService->requestCreate($createSup);

        $createLine = new SupplyRequest();
        $createLine->supplyId = $createSup->supplyId;
        $createLine->subjigId = 'K2FSA';
        $createLine->jumlahLineA = 10;
        $createLine->jumlahLineB = 10;
        $createLine->jumlahLineC = 10;
        $this->lineService->requestCreate($createLine);

        $createLine = new SupplyRequest();
        $createLine->supplyId = $createSup->supplyId;
        $createLine->subjigId = 'K2FSB';
        $createLine->jumlahLineA = 10;
        $createLine->jumlahLineB = 10;
        $createLine->jumlahLineC = 10;
        $this->lineService->requestCreate($createLine);

        assertNotNull($response);
    }

    protected function setUp(): void
    {
        $lineRep = new LineRepository(Database::getConnection());
        $supplyRep = new SupplyRepository(Database::getConnection());

        $this->lineService = new LineService($lineRep);
        $this->supplyService = new SupplyService($supplyRep);

        $supplyRep->deleteAll();
    }
}
