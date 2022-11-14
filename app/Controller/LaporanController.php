<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\K2FRepository;
use Subjig\Report\Repository\SupplyRepository;

class LaporanController
{
    private K2FRepository $K2FRepository;
    private SupplyRepository $supplyRepository;

    public function __construct()
    {
        $this->K2FRepository = new K2FRepository(Database::getConnection());
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | Laporan'
        ];
        View::render('Admin/Laporan/index', compact('model'));
    }

    public function t2022()
    {
        $model = [
            'title' => 'Admin | Laporan'
        ];
        View::render('Admin/Laporan/2022/index', compact('model'));
    }

    public function subjig()
    {
        $model = [
            'title' => 'Admin | Laporan Subjig'
        ];
        View::render('Admin/Laporan/2022/Subjig/index', compact('model'));
    }

    public function k2f()
    {
        $result = [];
        foreach ($this->supplyRepository->findAll() as $item => $value) {
            $result[] = $this->supplyRepository->supplyK2f($value->getSupplyId());
        }
        $model = [
            'title' => 'Admin | Laporan Subjig',
            'joinSupply' => $result,
            'allK2f' => $this->K2FRepository->findAll(),
            'allSupply' => $this->supplyRepository->findAll(),
            'periode' => [
                '2022'
            ]
        ];
        View::render('Admin/Laporan/2022/Subjig/k2f', compact('model'));
    }
}