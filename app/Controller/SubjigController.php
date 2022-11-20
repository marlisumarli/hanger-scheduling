<?php

namespace Subjig\Report\Controller;

use Subjig\Report\App\View;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\SubjigRequest;
use Subjig\Report\Repository\SubjigRepository;
use Subjig\Report\Repository\TypeRepository;
use Subjig\Report\Service\SubjigService;

class SubjigController
{
    private SubjigRepository $subjigRepository;
    private SubjigService $subjigService;
    private TypeRepository $typeRepository;

    public function __construct()
    {
        $this->subjigRepository = new SubjigRepository(Database::getConnection());
        $this->subjigService = new SubjigService($this->subjigRepository);
        $this->typeRepository = new TypeRepository(Database::getConnection());
    }

    public function index(string $id)
    {
        $model = [
            'title' => "Admin | Subjig $id",
            'typeId' => $id,
            'allSubjig' => $this->subjigRepository->data($id),
        ];
        View::render('Admin/Subjig/index', compact('model'));
    }

    public function list(string $id)
    {
        $model = [
            'title' => "Admin | Subjig $id",
            'allSubjig' => $this->subjigRepository->data($id),
            'typeQty' => $this->typeRepository->findById($id)->getTypeQty(),
        ];
        View::render('Admin/Subjig/list', compact('model'));
    }

    public function postList(string $id)
    {
        if (isset($_POST['create'])) {
            try {
                for ($i = 0; $i < count($_POST['orderNumber']); $i++) {
                    $subjigName = $_POST['subjigName'][ $i ];
                    $qty = $_POST['qty'][ $i ];

                    $request = new SubjigRequest();
                    $request->name = $subjigName;
                    $request->type = $id;
                    $request->qty = $qty;
                    $this->subjigService->requestCreate($request);
                }
                $model = [
                    'success' => "/admin/subjig/$id",
                    'allSubjig' => $this->subjigRepository->data($id),
                    'typeQty' => $this->typeRepository->findById($id)->getTypeQty(),
                ];
                View::render('Admin/Subjig/List', compact('model'));
            } catch (ValidationException $exception) {
                $model = [
                    'title' => "Admin | Subjig $id",
                    'error' => $exception->getMessage(),
                    'allSubjig' => $this->subjigRepository->data($id),
                    'typeQty' => $this->typeRepository->findById($id)->getTypeQty()
                ];
                View::render('Admin/Subjig/list', compact('model'));
            }
        } elseif (isset($_POST['update'])) {
            try {
                foreach ($this->subjigRepository->data($id) as $key => $value) {
                    $orderNumber = $_POST['updateOrderNumber'][ $key ];
                    $subjigName = $_POST['updateSubjigName'][ $key ];
                    $qty = $_POST['updateQty'][ $key ];

                    $request = new SubjigRequest();
                    $request->id = $value->getSubjigId();
                    $request->orderNumber = $orderNumber;
                    $request->name = $subjigName;
                    $request->type = $id;
                    $request->qty = $qty;
                    $this->subjigService->requestUpdate($request);
                }
                $model = [
                    'success' => "/admin/subjig/$id",
                    'allSubjig' => $this->subjigRepository->data($id),
                    'typeQty' => $this->typeRepository->findById($id)->getTypeQty(),
                ];
                View::render('Admin/Subjig/List', compact('model'));
            } catch (ValidationException $exception) {
                $model = [
                    'title' => "Admin | Subjig $id",
                    'error' => $exception->getMessage(),
                    'allSubjig' => $this->subjigRepository->data($id),
                    'typeQty' => $this->typeRepository->findById($id)->getTypeQty()
                ];
                View::render('Admin/Subjig/list', compact('model'));
            }
        }
    }

    public function delete(string $type, string $id)
    {
        $request = new SubjigRequest();
        $request->id = $id;
        $request->type = $type;
        try {
            $this->subjigService->requestDelete($request);

            $model = [
                'success' => "/admin/subjig/$type"
            ];
            View::render('Admin/Subjig/delete', compact('model'));
        } catch (\Exception $exception) {
            $model = [
                'error' => $exception->getMessage(),
                'direct' => "/admin/subjig/$type/list"
            ];
            View::render('Admin/Subjig/delete', compact('model'));
        }
    }
}