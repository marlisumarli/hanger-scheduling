<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\CategoryCreateRequest;
use Subjig\Report\Model\CategoryDeleteRequest;
use Subjig\Report\Model\CategoryNameUpdateRequest;
use Subjig\Report\Repository\CategoryRepository;

class CategoryServiceTest extends TestCase
{
    private CategoryRepository $categoryRepository;
    private CategoryService $categoryService;

    public function testSave()
    {
        $request = new CategoryCreateRequest();
        $request->categoryId = 'K1A';
        $request->categoryName = "Benar";

        $response = $this->categoryService->requestCreate($request);

        self::assertEquals($request->categoryId, $response->category->category_id);
    }

    public function testDelete()
    {
        $crt = new CategoryCreateRequest();
        $crt->categoryId = 'K1A';
        $crt->categoryName = "Benar";
        $this->categoryService->requestCreate($crt);

        $request = new CategoryDeleteRequest();
        $request->categoryId = "K1A";
        $this->categoryService->requestDelete($request);

        $response = $this->categoryRepository->findById($request->categoryId);

        self::assertNull($response);
    }

    public function testUpdate()
    {
        $crt = new CategoryCreateRequest();
        $crt->categoryId = 'K1A';
        $crt->categoryName = "Benar";
        $this->categoryService->requestCreate($crt);

        $cr = new CategoryNameUpdateRequest();
        $cr->categoryId = 'K1A';
        $cr->newCategoryId = 'K1AC';
        $cr->categoryName = "Salah";
        $this->categoryService->requestUpdate($cr);
        $result = $this->categoryRepository->findById($cr->newCategoryId);

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->categoryRepository = new CategoryRepository(Database::getConnection());
        $this->categoryService = new CategoryService($this->categoryRepository);

        $this->categoryRepository->deleteAll();
    }
}
