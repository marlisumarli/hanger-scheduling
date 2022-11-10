<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\K2FCreateRequest;
use Subjig\Report\Model\K2FDeleteRequest;
use Subjig\Report\Model\K2FUpdateRequest;
use Subjig\Report\Repository\K2FRepository;

class K2FServiceTest extends TestCase
{
    private K2FService $k2FService;
    private K2FRepository $k2FRepository;

    public function testCreateK2F()
    {
        $request = new K2FCreateRequest();
        $request->id = $type . "SPDMTA";
        $request->name = "Speedometer A";
        $request->qty = 4;
        $response = $this->k2FService->requestCreate($request);
        $request = new K2FCreateRequest();
        $request->id = $type . "SPDMTB";
        $request->name = "Speedometer A";
        $request->qty = 4;
        $response = $this->k2FService->requestCreate($request);
        $result = $this->k2FRepository->findByCode($request->code);
        self::assertEquals($request->code, $response->k2F->code);
        self::assertEquals($request->name, $response->k2F->name);
        self::assertNotNull($result->code);
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
        $add->code = $type . "SPDMTA";
        $add->name = "Speedometer A";
        $add->qty = 4;
        $this->k2FService->requestCreate($add);

        $request = new K2FDeleteRequest();
        $request->code = "K2FSPDMTA";
        $this->k2FService->requestDelete($request);
        $result = $this->k2FRepository->findByCode($request->code);

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
