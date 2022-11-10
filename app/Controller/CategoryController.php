<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\CategoryCreateRequest;
use Subjig\Report\Model\CategoryDeleteRequest;
use Subjig\Report\Model\CategoryIdUpdateRequest;
use Subjig\Report\Model\CategoryNameUpdateRequest;
use Subjig\Report\Repository\CategoryRepository;
use Subjig\Report\Service\CategoryService;

class CategoryController
{
    private CategoryService $categoryService;
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository(Database::getConnection());
        $this->categoryService = new CategoryService($this->categoryRepository);

    }

    public function index()
    {
        View::render('Admin/Category/index', [
            'title' => 'Admin | Category',
            'category' => $this->categoryRepository->findAll()
        ]);
    }

    private function render()
    {
        View::render('Admin/Category/update', [
            'title' => 'Admin | Update Category',
            'success' => 'Berhasil disimpan',
            'category' => $this->categoryRepository->findAll(),
            'id' => $_GET['id'],
            'name' => $result->category_name ?? 'Subjig',
        ]);
    }

    public function postCreate()
    {
        $request = new CategoryCreateRequest();
        $request->categoryId = $_POST['categoryId'];
        $request->categoryName = $_POST['categoryName'];
        try {
            $this->categoryService->requestCreate($request);
            View::render('Admin/Category/index', [
                'title' => 'Admin | Category',
                'category' => $this->categoryRepository->findAll(),
                'success' => 'Berhasil ditambahkan'
            ]);
        } catch (ValidationException $exception) {
            View::render('Admin/Category/index', [
                'title' => 'Admin | Category',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function update()
    {
        $result = $this->categoryRepository->findById($_GET['id']);
        View::render('Admin/Category/update', [
            'title' => 'Admin | Category Update',
            'id' => $_GET['id'],
            'name' => $result->category_name ?? View::redirect('/'),
        ]);

    }

    public function updateName()
    {
        $id = $_GET['id'];
        View::redirect("/admin/categories-update?id=$id");
    }

    public function postUpdateName()
    {
        $result = $this->categoryRepository->findById($_GET['id']);
        $request = new CategoryNameUpdateRequest();
        $request->categoryId = $_GET['id'];
        $request->categoryName = $_POST['name'];
        try {
            $this->categoryService->requestUpdateName($request);
            $this->render();
        } catch (ValidationException $exception) {
            View::render('Admin/Category/update', [
                'title' => 'Admin | Update Category',
                'error' => $exception->getMessage(),
                'category' => $this->categoryRepository->findAll(),
                'id' => $_GET['id'],
                'name' => $result->category_name ?? 'Subjig',
            ]);
        }
    }

    public function updateId()
    {
        $id = $_GET['id'];
        View::redirect("/admin/categories-update?id=$id");
    }

    public function postUpdateId()
    {
        $result = $this->categoryRepository->findById($_GET['id']);
        $request = new CategoryIdUpdateRequest();
        $request->categoryId = $_GET['id'];
        $request->newCategoryId = $_POST['newId'];
        try {
            $this->categoryService->requestUpdateId($request);
            $this->render();
        } catch (ValidationException $exception) {
            View::render('Admin/Category/update', [
                'title' => 'Admin | Update Category',
                'error' => $exception->getMessage(),
                'category' => $this->categoryRepository->findAll(),
                'id' => $_GET['id'],
                'name' => $result->category_name ?? 'Subjig',
            ]);
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $request = new CategoryDeleteRequest();
            $request->categoryId = $id;
            $this->categoryService->requestDelete($request);

            View::render('Admin/Category/delete', [
                'success' => '/admin/categories'
            ]);
        }
    }
}