<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Repository\HangerTypeRepository;

class AdminDataReportController
{
    private SupplyRepository $supplyRepository;
    private HangerTypeRepository $typeRepository;

    public function __construct()
    {
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->typeRepository = new HangerTypeRepository(Database::getConnection());
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | DataReport',
            'allType' => $this->typeRepository->findAll()
        ];
        View::render('Admin/DataReport/index', compact('model'));
    }

    public function supply(string $id)
    {
        $result = [];
        foreach ($this->supplyRepository->findAll($id) as $item => $value) {
            $result[] = $this->supplyRepository->allSupplyLine($value->getSupplyId());
        }
        $model = [
            'title' => "Admin | DataReport Supply $id",
            'allSupplyDate' => $this->supplyRepository->findAll($id),
            'allSupplyLine' => $result,
        ];
        View::render('Admin/DataReport/supply', compact('model'));
    }

}