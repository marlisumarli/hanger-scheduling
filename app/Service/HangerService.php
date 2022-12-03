<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\HangerRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\Hanger;
use Subjig\Report\Model\HangerType;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;

class HangerService
{
    private HangerRepository $hangerRepository;

    /**
     * @param HangerRepository $hangerRepository
     */
    public function __construct(HangerRepository $hangerRepository)
    {
        $this->hangerRepository = $hangerRepository;
    }

    public function requestCreate(HangerRequest $request): ResponseSubjigApp
    {

        $this->validateColumnCreateRequest($request);

        try {
            Database::beginTransaction();

            $hanger = new Hanger();
            $hanger->setId($request->hangerTypeId . '-' . substr(uniqid(), -2));
            $hanger->setHangerTypeId($request->hangerTypeId);
            $hanger->setOrderNumber(count($this->hangerRepository->findHangerTypeId($hanger->getHangerTypeId())) + 1);
            $hanger->setName(ucwords(trim($request->name)));
            $hanger->setQty($request->qty);
            $this->hangerRepository->save($hanger);

            $response = new ResponseSubjigApp();
            $response->hanger = $hanger;

            Database::commitTransaction();

            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(HangerRequest $subjigRequest): void
    {
        if (trim($subjigRequest->name) == '' || ($subjigRequest->qty && $subjigRequest->name) == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z| ]/i', $subjigRequest->name)) {
            throw new ValidationException('Tidak valid!');
        }
    }

    public function requestUpdate(HangerRequest $request): ResponseSubjigApp
    {
        $this->validateColumnCreateRequest($request);

        try {
            Database::beginTransaction();

            $hanger = new Hanger();
            $hanger->setId($request->hangerId);
            $hanger->setOrderNumber($request->orderNumber);
            $hanger->setHangerTypeId($request->hangerTypeId);
            $hanger->setName(ucwords(trim($request->name)));
            $hanger->setQty($request->qty);
            $this->hangerRepository->update($hanger);

            $response = new ResponseSubjigApp();
            $response->hanger = $hanger;

            Database::commitTransaction();

            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestDelete(HangerRequest $request): ResponseSubjigApp
    {
        $response = new ResponseSubjigApp();
        $typeRepository = new HangerTypeRepository(Database::getConnection());

        try {
            Database::beginTransaction();

            $hangerModel = new Hanger();
            $hangerModel->setId($request->hangerId);
            $this->hangerRepository->deleteById($hangerModel->getId());

            $type = new HangerType();
            $type->setId($request->hangerTypeId);
            $type->setQty($typeRepository->findById($request->hangerTypeId)->getQty() - 1);
            $typeRepository->update($type);

            $hangers = $this->hangerRepository->findHangerTypeId($request->hangerTypeId);

            foreach ($hangers as $key => $hanger) {

                $hangerModel = new Hanger();
                $hangerModel->setId($hanger->getId());
                $hangerModel->setName(null);
                $hangerModel->setOrderNumber($key + 1);
                $this->hangerRepository->update($hangerModel);

            }
            $response->hanger = $hangerModel;

            Database::commitTransaction();

        } catch (Exception) {
            Database::rollBackTransaction();
            throw new Exception('Tidak boleh menghapus subjig yang sudah dibuat laporan');
        }
        return $response;
    }
}