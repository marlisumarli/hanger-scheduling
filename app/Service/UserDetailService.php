<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\UserDetail;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserDetailCreateRequest;
use Subjig\Report\Model\UserDetailResponse;
use Subjig\Report\Model\UserDetailUpdateRequest;
use Subjig\Report\Repository\UserDetailRepository;

class UserDetailService
{
    private UserDetailRepository $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
    }

    public function requestCreateUserDetail(UserDetailCreateRequest $request): UserDetailResponse
    {
        $this->validationCreateRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userDetailRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException('User ada');
            } else {
                $userDetail = new  UserDetail();
                $userDetail->user_detail_id = uniqid();
                $userDetail->username = $request->username;
                $userDetail->full_name = ucwords(strtolower(trim($request->fullName)));
                $userDetail->role_id = $request->roleId;
                $this->userDetailRepository->save($userDetail);
            }

            $response = new UserDetailResponse();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validationCreateRequest(UserDetailCreateRequest $request): void
    {
        if (preg_match('/[^a-zA-Z| ]/i', $request->fullName) || $request->fullName == '') {
            throw new ValidationException('Invalid characters');
        }
    }

    public function requestUpdateUserDetail(UserDetailUpdateRequest $request): UserDetailResponse
    {
        $this->validationUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userDetailRepository->findByUsername($request->username);
            if ($user == null) {
                throw new ValidationException('Update failed');
            } else {
                $userDetail = new  UserDetail();
                $userDetail->username = $request->username;
                $userDetail->full_name = ucwords(strtolower(trim($request->fullName)));
                $userDetail->role_id = $request->roleId;
                $this->userDetailRepository->update($userDetail);
            }
            $response = new UserDetailResponse();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validationUpdateRequest(UserDetailUpdateRequest $request): void
    {
        if (preg_match('/[^a-zA-Z| ]/i', $request->fullName) || ($request->fullName == '')) {
            throw new ValidationException('Invalid characters');
        }
    }
}