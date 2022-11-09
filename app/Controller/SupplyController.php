<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\CategoryRepository;

class SupplyController
{
    private CategoryRepository $categoryRepository;


    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository(Database::getConnection());
    }

    public function index(): void
    {
        View::render('Admin/Supply/index', [
            'title' => 'Supply Subjig'
        ]);
    }

    public function supply(string $id): void
    {
//        $this->categoryRepository->findByKode(); TODO Belom
        View::render('Admin/Supply/K2F/index', [
            'title' => 'Supply Subjig',
            'id' => $id
        ]);
    }
}