<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\UserDetail;
use Subjig\Report\Model\UserDetailRequest;
use Subjig\Report\Model\UserDetailResponse;
use Subjig\Report\Repository\UserDetailRepository;

class UserDetailService
{
    private UserDetailRepository $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
    }

    public function submit(UserDetailRequest $request): UserDetailResponse
    {
        try {
            Database::beginTransaction();

            $userDetail = new  UserDetail();
            $userDetail->id = uniqid();
            $userDetail->credential = $request->credential;
            $userDetail->fullName = $request->fullName;
            $userDetail->roleId = $request->role;
            $this->userDetailRepository->save($userDetail);

            $response = new UserDetailResponse();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }
}