<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Category;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\CategoryCreateRequest;
use Subjig\Report\Model\CategoryDeleteRequest;
use Subjig\Report\Model\CategoryIdUpdateRequest;
use Subjig\Report\Model\CategoryNameUpdateRequest;
use Subjig\Report\Model\CategoryResponse;
use Subjig\Report\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function requestCreate(CategoryCreateRequest $request): CategoryResponse
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $categoryId = $this->categoryRepository->findById($request->categoryId);
            $categoryName = $this->categoryRepository->findById($request->categoryName);
            if ($categoryId != null) {
                throw new ValidationException("Id : $request->categoryId sudah ada");
            } elseif ($categoryName != null) {
                throw new ValidationException("Category : $request->categoryName sudah ada");
            }

            $category = new Category();
            $category->category_id = strtoupper(trim($request->categoryId));
            $category->category_name = ucwords(strtolower(trim($request->categoryName)));
            $this->categoryRepository->save($category);

            $response = new CategoryResponse();
            $response->category = $category;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(CategoryCreateRequest $request): void
    {
        if ($request->categoryId == null || $request->categoryName == null || trim($request->categoryId) == '' || trim($request->categoryName) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^A-Z0-9]/i', $request->categoryId) || preg_match('/[^a-zA-Z0-9| ]/i', $request->categoryName)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestUpdateName(CategoryNameUpdateRequest $request): CategoryResponse
    {
        $this->validateColumnNameUpdateRequest($request);
        try {
            Database::beginTransaction();

            $categoryName = $this->categoryRepository->findByName($request->categoryName);
            if ($categoryName != null) {
                throw new ValidationException("$request->categoryName : Sudah ada");
            }

            $category = new Category();
            $category->category_id = $request->categoryId;
            $category->category_name = ucwords(strtolower(trim($request->categoryName)));
            $this->categoryRepository->updateName($category);

            $response = new CategoryResponse();
            $response->category = $category;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnNameUpdateRequest(CategoryNameUpdateRequest $request): void
    {
        if ($request->categoryName == null || trim($request->categoryName) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z0-9| ]/i', $request->categoryName)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestUpdateId(CategoryIdUpdateRequest $request): CategoryResponse
    {
        $this->validateColumnIdUpdateRequest($request);
        try {
            Database::beginTransaction();

            $newCategoryId = $this->categoryRepository->findById($request->newCategoryId);
            if ($newCategoryId != null) {
                throw new ValidationException("$request->newCategoryId : Sudah ada");
            }

            $category = new Category();
            $category->category_id = $request->categoryId;
            $category->new_category_id = strtoupper(trim($request->newCategoryId));
            $this->categoryRepository->updateId($category);

            $response = new CategoryResponse();
            $response->category = $category;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnIdUpdateRequest(CategoryIdUpdateRequest $request): void
    {
        if ($request->newCategoryId == null || trim($request->newCategoryId) == '') {
            throw new ValidationException('Kolom tidak boleh kosong');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $request->newCategoryId)) {
            throw new ValidationException('Invalid character');
        }
    }

    public function requestDelete(CategoryDeleteRequest $request): CategoryResponse
    {
        $category = $this->categoryRepository->findById($request->categoryId);
        if ($category == null) {
            throw new ValidationException('Hapus gagal');
        } else {
            $category = new  Category();
            $category->category_id = $request->categoryId;
            $this->categoryRepository->deleteById($category->category_id);
        }
        $response = new CategoryResponse();
        $response->category = $category;
        return $response;
    }
}