<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\HangerTypeRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\HangerType;
use Subjig\Report\Repository\HangerRepository;
use Subjig\Report\Repository\HangerTypeRepository;

class HangerTypeService
{
    private HangerTypeRepository $typeRepository;

    /**
     * @param HangerTypeRepository $typeRepository
     */
    public function __construct(HangerTypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function requestCreate(HangerTypeRequest $request): ResponseSubjigApp
    {

        $this->validateColumnCreateRequest($request);

        try {
            Database::beginTransaction();

            $id = $this->typeRepository->findById(strtoupper($request->id));
            if ($id != null) {
                throw new ValidationException("ID : " . strtoupper($request->id) . " sudah ada");
            }

            $type = new HangerType();
            $type->setId(strtolower(trim($request->id)));
            $type->setQty($request->qty);
            $this->typeRepository->save($type);

            $response = new ResponseSubjigApp();
            $response->hangerType = $type;

            Database::commitTransaction();

            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validateColumnCreateRequest(HangerTypeRequest $typeRequest): void
    {
        if (trim($typeRequest->id) == '' || ($typeRequest->id && $typeRequest->qty) == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $typeRequest->id)) {
            throw new ValidationException('Tidak valid!');
        }
    }

    public function requestUpdate(HangerTypeRequest $request): ResponseSubjigApp
    {
        $response = new ResponseSubjigApp();

        if (isset($request->newId)) {

            $this->validateColumnUpdateRequest($request);

            try {
                Database::beginTransaction();

                $id = $this->typeRepository->findById(strtoupper($request->newId));
                if ($id != null) {
                    throw new ValidationException("Id : " . strtoupper($request->newId) . " sudah ada");
                }

                $hangerType = new HangerType();
                $hangerType->setNewId(strtoupper(trim($request->newId)));
                $hangerType->setId($request->id);
                $this->typeRepository->update($hangerType);

                $response->hangerType = $hangerType;

                Database::commitTransaction();
            } catch (Exception $exception) {
                Database::rollBackTransaction();
                throw $exception;
            }
        } elseif (isset($request->qty)) {

            $hangerTypeId = $request->id;

            try {
                Database::beginTransaction();

                $hangerRepository = new HangerRepository(Database::getConnection());
                $hangers = count($hangerRepository->findHangerTypeId($hangerTypeId));

                if ($request->qty < $hangers) {
                    throw new ValidationException("HangerType Quantity tidak dapat diubah: Kurang dari jumlah Hanger saat ini");
                }

                $hangerType = new HangerType();
                $hangerType->setId($request->id);
                $hangerType->setQty($request->qty);
                $this->typeRepository->update($hangerType);

                $response->hangerType = $hangerType;

                Database::commitTransaction();
            } catch (Exception $exception) {
                Database::rollBackTransaction();
                throw $exception;
            }
        }
        return $response;
    }

    private function validateColumnUpdateRequest(HangerTypeRequest $typeRequest): void
    {
        if (trim($typeRequest->newId) == '' || $typeRequest->newId == null) {
            throw new ValidationException('Harus Diisi!');
        } elseif (preg_match('/[^a-zA-Z0-9]/i', $typeRequest->newId)) {
            throw new ValidationException('Tidak valid!');
        }
    }
}