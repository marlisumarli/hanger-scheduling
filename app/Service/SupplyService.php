<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
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

            $supply = new Supply();
            $supply->setId($request->scheduleSupplyId . $request->hangerTypeId);
            $supply->setHangerTypeId($request->hangerTypeId);
            $supply->setScheduleWeekId($request->scheduleSupplyId);
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
            $supply->setId($request->supplyId);
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