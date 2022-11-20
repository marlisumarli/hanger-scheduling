<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\TypeRequest;
use Subjig\Report\Repository\TypeRepository;

class TypeServiceTest extends TestCase
{
    private TypeService $typeService;

    public function testCreate()
    {
        $request = new TypeRequest();
        $request->newId = 'K2F';
        $request->id = 'K2FA';
        $response = $this->typeService->requestUpdate($request);

        self::assertNotNull($response);
    }

    protected function setUp(): void
    {
        $typeRepository = new TypeRepository(Database::getConnection());
        $this->typeService = new TypeService($typeRepository);
    }
}
