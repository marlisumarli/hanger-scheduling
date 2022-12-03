<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\HangerType;

class TypeRepositoryTest extends TestCase
{
    private HangerTypeRepository $typeRepository;

    public function testSave()
    {
        $type = new HangerType();
        $type->setTypeId('K2FA');
        $type->setTypeQty(8);
        $this->typeRepository->update($type);

        $result = $this->typeRepository->findById($type->getTypeId());

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->typeRepository = new HangerTypeRepository(Database::getConnection());
    }
}
