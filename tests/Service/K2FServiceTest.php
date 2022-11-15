<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\K2FRequest;
use Subjig\Report\Repository\K2FRepository;

class K2FServiceTest extends TestCase
{
    private K2FService $k2FService;
    private K2FRepository $k2FRepository;

    public function testCreateK2F()
    {
        $request = new K2FRequest();
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
        $request = new K2FRequest();
        $request->id = $type . "SPDMTA";
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
        $Strings = 'abcdefghijklmnopqrstuvwxyz';

        $i = 0;
        while ($i < 3000) {
            $add = new K2FRequest();
            $add->ordered = 1;
            $add->id = "K2FA$i";
            $add->name = substr(str_shuffle($Strings), 0, 10);;
            $add->qty = 4;
            $this->k2FService->requestCreate($add);
            $i++;
        }

        for ($i = 0; $i < 1000; $i++) {
            $add = new K2FRequest();
            $add->ordered = 1;
            $add->id = "K2FA$i";
            $add->name = substr(str_shuffle($Strings), 0, 10);;
            $add->qty = 4;
            $this->k2FService->requestCreate($add);
        }

        $request = new K2FRequest();
        $request->target = 300;
        $result = $this->k2FService->targetRequest($request);

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->k2FRepository = new K2FRepository(Database::getConnection());
        $this->k2FService = new K2FService($this->k2FRepository);

        $this->k2FRepository->deleteAll();
    }
}
