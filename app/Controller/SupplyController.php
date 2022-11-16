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
    private SupplyRepository $supplyRepository;
    private LineService $lineService;
    private LineRepository $lineRepository;

    public function __construct()
    {
        $this->k2FRepository = new K2FRepository(Database::getConnection());
        $this->lineRepository = new LineRepository(Database::getConnection());
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->lineService = new LineService($this->lineRepository);
        $this->supplyService = new SupplyService($this->supplyRepository);
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
                $createLine->supplyTarget = $_POST['target'];
                $this->lineService->requestCreate($createLine);
            }
            $model = [
                'title' => 'Admin | Supply K2F',
                'success' => '/admin/laporan/2022/subjig/k2f',
                'allK2f' => $this->k2FRepository->findAll(),
            ];
            View::render('Admin/Supply/Subjig/K2F/index', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'title' => 'Admin | Supply K2F',
                'error' => $exception->getMessage(),
                'allK2f' => $this->k2FRepository->findAll(),
            ];
            View::render('Admin/Supply/Subjig/K2F/index', compact('model'));
        }
    }

    public function updateK2f()
    {
        $idSupply = $_GET['id'];

        $model = [
            'title' => 'Admin | Update Supply K2F',
            'idSupply' => $this->supplyRepository->findById($idSupply),
            'allSupply' => $this->supplyRepository->supplyK2f($idSupply),
            'k2fText' => $this->k2FRepository::TYPE
        ];
        View::render('Admin/Supply/Subjig/K2F/update', compact('model'));
    }

    public function postUpdateK2f()
    {
        $idSupply = $_GET['id'];
        $allSupply = $this->supplyRepository->supplyK2f($idSupply);
        $date = $_POST['dateUpdate'];

        try {
            $updateSup = new SupplyRequest();
            $updateSup->supplyId = $idSupply;
            $updateSup->supplyDate = $date;
            $this->supplyService->requestUpdate($updateSup);

            foreach ($allSupply as $key => $value) {
                $createLine = new SupplyRequest();
                $createLine->lineId = $value->getJumlahId();
                $createLine->jumlahLineA = $_POST['k2fLnA'][ $key ];
                $createLine->jumlahLineB = $_POST['k2fLnB'][ $key ];
                $createLine->jumlahLineC = $_POST['k2fLnC'][ $key ];
                $createLine->supplyTarget = $_POST['target'];
                $this->lineService->requestUpdate($createLine);
            }
            $model = [
                'title' => 'Admin | Update Supply K2F',
                'success' => '/admin/laporan/2022/subjig/k2f',
                'idSupply' => $this->supplyRepository->findById($idSupply),
                'allSupply' => $this->supplyRepository->supplyK2f($idSupply),
                'k2fText' => $this->k2FRepository::TYPE,
            ];
            View::render('Admin/Supply/Subjig/K2F/update', compact('model'));

        } catch (ValidationException $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'title' => 'Admin | K2F',
                'allK2f' => $this->k2FRepository->findAll(),
            ];
            View::render('Admin/Supply/Subjig/K2F/update', compact('model'));
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $idSupply = $_GET['id'];
            $request = new SupplyRequest();
            $request->supplyId = $idSupply;
            $this->supplyService->requestDelete($request);

            $model = [
                'success' => '/admin/laporan/2022/subjig/k2f'
            ];
            View::render('Admin/Supply/Subjig/delete', compact('model'));
        }
    }
}