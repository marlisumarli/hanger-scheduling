<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\K2FCreateRequest;
use Subjig\Report\Model\K2FUpdateRequest;
use Subjig\Report\Repository\K2FRepository;

class K2FServiceTest extends TestCase
{
    private K2FService $k2FService;
    private K2FRepository $k2FRepository;

    public function testCreateK2F()
    {
        $request = new K2FCreateRequest();
        $request->id = "SPDMTA";
        $request->name = "Speedometer A";
        $request->qty = 4;;
        $response = $this->k2FService->requestCreate($request);
        $result = $this->k2FRepository->findById($request->id);
        self::assertEquals($request->id, $response->k2F->k2f_id);
        self::assertEquals($request->name, $response->k2F->k2f_name);
        self::assertNotNull($result->k2f_id);
    }

    public function testLogin()
    {
        $type = "K2F";
        $request = new K2FCreateRequest();
        $request->code = $type . "SPDMTA";
        $request->name = "Speedometer A";
        $request->qty = 4;
        $this->k2FService->requestCreate($request);

        $request = new K2FUpdateRequest();
        $request->code = "K2FSPDMTA";
        $request->name = "Speedometer B";
        $request->qty = 2;
        $response = $this->k2FService->requestUpdate($request);
        self::assertEquals($request->name, $response->k2F->name);
        self::assertEquals($request->qty, $response->k2F->qty);
    }

    public function testDelete()
    {
        $type = "K2F";
        $add = new K2FCreateRequest();
        $add->oId = 1;
        $add->id = $type . "SPDMTA";
        $add->name = "Speedometer A";
        $add->qty = 4;
        $this->k2FService->requestCreate($add);

        $add = new K2FCreateRequest();
        $add->oId = 2;
        $add->id = $type . "SPDMTB";
        $add->name = "Speedometer B";
        $add->qty = 4;
        $this->k2FService->requestCreate($add);

        $add = new K2FCreateRequest();
        $add->oId = 3;
        $add->id = $type . "SPDMTC";
        $add->name = "Speedometer C";
        $add->qty = 4;
        $this->k2FService->requestCreate($add);

        $add = new K2FCreateRequest();
        $add->oId = 4;
        $add->id = $type . "SPDMTD";
        $add->name = "Speedometer D";
        $add->qty = 4;
        $this->k2FService->requestCreate($add);

        $request = new K2FUpdateRequest();
        $request->id = "K2FSPDMTB";
        $request->oId = 2;
        $this->k2FService->requestUpdateOrder($request);
        $request = new K2FUpdateRequest();
        $request->id = "K2FSPDMTA";
        $request->oId = 1;
        $this->k2FService->requestUpdateOrder($request);

        $result = $this->k2FRepository->findById($request->id);


        self::assertNull($result);
    }

// TODO belum
    protected function setUp(): void
    {
        $this->k2FRepository = new K2FRepository(Database::getConnection());
        $this->k2FService = new K2FService($this->k2FRepository);

        $this->k2FRepository->deleteAll();
    }
}
