<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Type;

class TypeRepositoryTest extends TestCase
{
    private TypeRepository $typeRepository;

    public function testSave()
    {
        $type = new Type();
        $type->setTypeId('K2FA');
        $type->setTypeQty(8);
        $this->typeRepository->update($type);

        $result = $this->typeRepository->findById($type->getTypeId());

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->typeRepository = new TypeRepository(Database::getConnection());
    }
}
