<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\ScheduleRequest;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Repository\ScheduleWeekRepository;

class ScheduleWeekService
{
    private ScheduleWeekRepository $scheduleRepository;

    /**
     * @param ScheduleWeekRepository $scheduleRepository
     */
    public function __construct(ScheduleWeekRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function requestCreate(ScheduleRequest $request): ResponseSubjigApp
    {
        try {
            Database::beginTransaction();

            $schedule = new ScheduleWeek();
            $schedule->setId(str_replace(array('/', '-'), '', $request->scheduleDate) . $request->supplyScheduleId);
            $schedule->setScheduleSupplyId($request->supplyScheduleId);
            $schedule->setDate($request->scheduleDate);
            $schedule->setMId($request->mId);
            $schedule->setIsImplemented($request->isImplemented);
            $this->scheduleRepository->save($schedule);

            $response = new ResponseSubjigApp();
            $response->scheduleWeek = $schedule;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}