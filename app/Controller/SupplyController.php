<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\SupplyRequest;
use Subjig\Report\Repository\K2FRepository;
use Subjig\Report\Repository\LineRepository;
use Subjig\Report\Repository\SupplyRepository;
use Subjig\Report\Service\LineService;
use Subjig\Report\Service\SupplyService;


class SupplyController
{
    private K2FRepository $k2FRepository;
    private SupplyService $supplyService;
    private LineService $lineService;

    public function __construct()
    {
        $this->k2FRepository = new K2FRepository(Database::getConnection());
        $lineRep = new LineRepository(Database::getConnection());
        $supplyRep = new SupplyRepository(Database::getConnection());

        $this->lineService = new LineService($lineRep);
        $this->supplyService = new SupplyService($supplyRep);
    }

    public function index()
    {
        $model = [
            'title' => 'Admin | Supply'
        ];
        View::render('Admin/Supply/index', compact('model'));
    }

    public function K2f()
    {
        $model = [
            'title' => 'Admin | Supply K2F',
            'allK2f' => $this->k2FRepository->findAll(),
            'k2fText' => $this->k2FRepository::TYPE
        ];
        View::render('Admin/Supply/Subjig/K2F/index', compact('model'));
    }

    public function postCreateK2f()
    {
        $allK2f = $this->k2FRepository->findAll();
        $date = $_POST['date'];
        $type = $this->k2FRepository::TYPE;

        try {
            $createSup = new SupplyRequest();
            $createSup->supplyId = str_replace(array("-", ":", "/"), '', $date) . $type;
            $createSup->supplyDate = $date;
            $this->supplyService->requestCreate($createSup);

            foreach ($allK2f as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->supplyId = $createSup->supplyId;
                $createLine->subjigId = $value->getK2fId();
                $createLine->jumlahLineA = $_POST['k2fLnA'][ $key ];
                $createLine->jumlahLineB = $_POST['k2fLnB'][ $key ];
                $createLine->jumlahLineC = $_POST['k2fLnC'][ $key ];
                $this->lineService->requestCreate($createLine);
            }
            $model = [
                'title' => 'Admin | K2F',
                'allK2f' => $this->k2FRepository->findAll(),
            ];
            View::render('Admin/Supply/Subjig/K2F/index', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'title' => 'Admin | K2F',
                'allK2f' => $this->k2FRepository->findAll(),
            ];
            View::render('Admin/Supply/Subjig/K2F/index', compact('model'));
        }
    }
}