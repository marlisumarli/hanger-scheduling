<?php

namespace Subjig\Report\Service;

use DateTime;
use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\SupplySchedule;
use Subjig\Report\Repository\ScheduleSupplyRepository;

class ScheduleSupplyService
{
    private ScheduleSupplyRepository $scheduleSubjigRepository;

    /**
     * @param ScheduleSupplyRepository $scheduleSubjigRepository
     */
    public function __construct(ScheduleSupplyRepository $scheduleSubjigRepository)
    {
        $this->scheduleSubjigRepository = $scheduleSubjigRepository;
    }

    public function requestCreate(ScheduleRequest $request): ResponseSubjigApp
    {
        $date = new DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $year = $date->format('Y');
        $month = $date->format('F');

        try {
            Database::beginTransaction();

            $scheduleSubjig = new SupplySchedule();
            $scheduleSubjig->setId($year.strtoupper($month.$request->hangerTypeId));
            $scheduleSubjig->setHangerTypeId($request->hangerTypeId);
            $this->scheduleSubjigRepository->save($scheduleSubjig);

            $response = new ResponseSubjigApp();
            $response->supplySchedule = $scheduleSubjig;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}