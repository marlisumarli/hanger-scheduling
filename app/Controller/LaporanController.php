<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\TypeRepository;

class LaporanController
{
    private SupplyRepository $supplyRepository;
    private TypeRepository $typeRepository;

    public function __construct()
    {
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->typeRepository = new TypeRepository(Database::getConnection());
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | Laporan',
            'allType' => $this->typeRepository->findAll()
        ];
        View::render('Admin/Laporan/index', compact('model'));
    }

    public function supply(string $id)
    {
        $result = [];
        foreach ($this->supplyRepository->findAll($id) as $item => $value) {
            $result[] = $this->supplyRepository->allSupplyLine($value->getSupplyId());
        }
        $model = [
            'title' => "Admin | Laporan Supply $id",
            'allSupplyDate' => $this->supplyRepository->findAll($id),
            'allSupplyLine' => $result,
        ];
        View::render('Admin/Laporan/supply', compact('model'));
    }
}