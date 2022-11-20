<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\Repository\LineRepository;
use Subjig\Report\Repository\SupplyRepository;
use function PHPUnit\Framework\assertNotNull;

class SupplyServiceTest extends TestCase
{
    private SupplyService $supplyService;
    private LineService $lineService;

    public function testRequestCreate()
    {
        $date = '2022-10-12';
        $type = 'A';

        $createSup = new SupplyRequest();
        $createSup->supplyId = str_replace(array("-", ":", "/"), '', $date) . $type;
        $createSup->supplyDate = $date;
        $createSup->typeId = $type;
        $createSup->supplyTarget = 200;
        $response = $this->supplyService->requestCreate($createSup);

        $createLine = new SupplyRequest();
        $createLine->supplyId = $createSup->supplyId;
        $createLine->subjigId = 'AB0';
        $createLine->jumlahLineA = 10;
        $createLine->jumlahLineB = 10;
        $createLine->jumlahLineC = 10;
        $createLine->supplyTarget = 10;
        $this->lineService->requestCreate($createLine);

        assertNotNull($response);
    }

    protected function setUp(): void
    {
        $lineRep = new LineRepository(Database::getConnection('prod'));
        $supplyRep = new SupplyRepository(Database::getConnection('prod'));

        $this->lineService = new LineService($lineRep);
        $this->supplyService = new SupplyService($supplyRep);
    }
}
