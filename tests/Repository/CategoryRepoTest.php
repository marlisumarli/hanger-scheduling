<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Category;

class CategoryRepoTest extends TestCase
{
    private CategoryRepository $categoryRepository;

    public function testSaveSuccess()
    {
        $category = new Category();
        $category->kode = 'SK2FLNA';
        $category->name = 'Supply K2F Line A';

        $this->categoryRepository->save($category);

        $result = $this->categoryRepository->findByKode($category->kode);
        self::assertEquals($category->kode, $result->kode);
        self::assertEquals($category->name, $result->name);
        self::assertNotNull($result->createdAt);

    }

    public function testFindById()
    {
        $category = new Category();
        $category->kode = 'SK2FLNA';
        $category->name = 'Supply K2F Line A';

        $this->categoryRepository->save($category);

        $result = $this->categoryRepository->findByKode($category->kode);

        self::assertEquals($category->kode, $result->kode);
        self::assertEquals($category->name, $result->name);
    }

    public function testUpdate()
    {
        $category = new Category();
        $category->kode = 'SK2FLNA';
        $category->name = 'Supply K2F Line B';

        $this->categoryRepository->save($category);

        $category = new Category();
        $category->kode = 'SK2FLNA';
        $category->name = 'Supply K2F Line A';

        $this->categoryRepository->update($category);

        $result = $this->categoryRepository->findByKode($category->kode);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $category = new Category();
        $category->kode = 'SK2FLNA';
        $category->name = 'Supply K2F Line A';

        $this->categoryRepository->save($category);

        $this->categoryRepository->deleteByKode($category->kode);

        $result = $this->categoryRepository->findByKode($category->kode);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->categoryRepository = new CategoryRepository(Database::getConnection());
        $this->categoryRepository->deleteAll();
    }
}
