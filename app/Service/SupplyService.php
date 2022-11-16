<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Supply;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\SupplyRequest;
use Subjig\Report\Model\SupplyResponse;
use Subjig\Report\Repository\SupplyRepository;

class SupplyService
{
    private SupplyRepository $supplyRepository;

    public function __construct(SupplyRepository $supplyRepository)
    {
        $this->supplyRepository = $supplyRepository;
    }

    public function requestCreate(SupplyRequest $request): SupplyResponse
    {
        try {
            Database::beginTransaction();

            $supply = $this->supplyRepository->findById($request->supplyId);
            if ($supply != null) {
                throw new ValidationException("ID Laporan : [$request->supplyId] sudah ada, coba untuk ganti ke tanggal lain terlebih dahulu");
            }

            $supply = new Supply();
            $supply->setSupplyId($request->supplyId);
            $supply->setSupplyDate($request->supplyDate);
            $this->supplyRepository->save($supply);

            $response = new SupplyResponse();
            $response->supply = $supply;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestUpdate(SupplyRequest $request): SupplyResponse
    {
        try {
            Database::beginTransaction();

            $supply = new Supply();
            $supply->setSupplyId($request->supplyId);
            $supply->setSupplyId($request->supplyDate);
            $this->supplyRepository->update($supply);

            $response = new SupplyResponse();
            $response->supply = $supply;

            Database::commitTransaction();
            return $response;
        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestDelete(SupplyRequest $request): SupplyResponse
    {
        $supply = new  Supply();
        $supply->setSupplyId($request->supplyId);
        $this->supplyRepository->deleteById($supply->getSupplyId());
        $response = new SupplyResponse();
        $response->supply = $supply;
        return $response;
    }
}