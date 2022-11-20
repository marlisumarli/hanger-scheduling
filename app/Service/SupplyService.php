<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\SupplyRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\Supply;
use Subjig\Report\Repository\SupplyRepository;

class SupplyService
{
    private SupplyRepository $supplyRepository;

    public function __construct(SupplyRepository $supplyRepository)
    {
        $this->supplyRepository = $supplyRepository;
    }

    public function requestCreate(SupplyRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $supply = $this->supplyRepository->findById($request->supplyId);
            if ($supply != null) {
                throw new ValidationException("ID Laporan : [$request->supplyId] sudah ada, coba untuk ganti ke tanggal lain terlebih dahulu");
            }

            $supply = new Supply();
            $supply->setSupplyId($request->supplyId);
            $supply->setTypeId($request->typeId);
            $supply->setSupplyDate($request->supplyDate);
            $supply->setTargetSet($request->supplyTarget);
            $this->supplyRepository->save($supply);

            $response = new ResponseSubjigApp();
            $response->supply = $supply;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestUpdate(SupplyRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $supply = new Supply();
            $supply->setSupplyId($request->supplyId);
            $supply->setSupplyDate($request->supplyDate);
            $supply->setTargetSet($request->supplyTarget);
            $this->supplyRepository->update($supply);

            $response = new ResponseSubjigApp();
            $response->supply = $supply;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestDelete(SupplyRequest $request): ResponseSubjigApp
    {
        $supply = new  Supply();
        $supply->setSupplyId($request->supplyId);
        $this->supplyRepository->deleteById($supply->getSupplyId());
        $response = new ResponseSubjigApp();
        $response->supply = $supply;
        return $response;
    }
}