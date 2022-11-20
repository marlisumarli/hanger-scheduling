<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\SubjigRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\Subjig;
use Subjig\Report\Model\Type;
use Subjig\Report\Repository\SubjigRepository;
use Subjig\Report\Repository\TypeRepository;

class SubjigService
{
    private SubjigRepository $subjigRepository;

    /**
     * @param SubjigRepository $subjigRepository
     */
    public function __construct(SubjigRepository $subjigRepository)
    {
        $this->subjigRepository = $subjigRepository;
    }

    public function requestCreate(SubjigRequest $request): ResponseSubjigApp
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $subjig = new Subjig();
            $subjig->setSubjigId($request->type . strtoupper(substr(uniqid(), -2)));
            $subjig->setTypeId($request->type);
            $subjig->setSubjigName(ucwords(trim($request->name)));
            $subjig->setSubjigQty($request->qty);
            $subjig->setOrderNumber(count($this->subjigRepository->data($subjig->getTypeId())) + 1);
            $this->subjigRepository->save($subjig);

            $response = new ResponseSubjigApp();
            $response->subjig = $subjig;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(SubjigRequest $subjigRequest): void
    {
        if (trim($subjigRequest->name) == '' || ($subjigRequest->qty && $subjigRequest->name) == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z| ]/i', $subjigRequest->name)) {
            throw new ValidationException('Tidak valid!');
        }
    }

    public function requestUpdate(SubjigRequest $request): ResponseSubjigApp
    {
        $this->validateColumnCreateRequest($request);
        try {
            Database::beginTransaction();

            $subjig = new Subjig();
            $subjig->setSubjigId($request->id);
            $subjig->setOrderNumber($request->orderNumber);
            $subjig->setTypeId($request->type);
            $subjig->setSubjigName(ucwords(trim($request->name)));
            $subjig->setSubjigQty($request->qty);
            $this->subjigRepository->update($subjig);

            $response = new ResponseSubjigApp();
            $response->subjig = $subjig;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function requestDelete(SubjigRequest $request): ResponseSubjigApp
    {
        $response = new ResponseSubjigApp();
        try {
            Database::beginTransaction();

            $subjig = new Subjig();
            $subjig->setSubjigId($request->id);
            $this->subjigRepository->deleteById($subjig->getSubjigId());

            $typeRepository = new TypeRepository(Database::getConnection());

            $type = new Type();
            $type->setTypeId($request->type);
            $type->setTypeQty($typeRepository->findById($request->type)->getTypeQty() - 1);
            $typeRepository->update($type);

            foreach ($this->subjigRepository->data($request->type) as $key => $value) {
                $subjig = new Subjig();
                $subjig->setSubjigId($value->getSubjigId());
                $subjig->setSubjigName(null);
                $subjig->setOrderNumber($key + 1);
                $this->subjigRepository->update($subjig);
            }
            $response->subjig = $subjig;
            Database::commitTransaction();

        } catch (Exception) {
            Database::rollBackTransaction();
            throw new Exception('Tidak boleh menghapus subjig yang sudah dibuat laporan');
        }
        return $response;
    }
}