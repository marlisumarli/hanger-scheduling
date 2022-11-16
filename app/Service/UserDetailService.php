<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\UserDetail;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\Model\UserRequest;
use Subjig\Report\Model\UserResponse;
use Subjig\Report\Repository\UserDetailRepository;

class UserDetailService
{
    private UserDetailRepository $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
    }

    public function requestCreateUserDetail(UserRequest $request): UserResponse
    {
        $this->validationCreateRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userDetailRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException('User ada');
            } else {
                $userDetail = new  UserDetail();
                $userDetail->setUserDetailId(uniqid());
                $userDetail->setUsername($request->username);
                $userDetail->setFullName(ucwords(strtolower(trim($request->fullName))));
                $userDetail->setRoleId($request->roleId);
                $this->userDetailRepository->save($userDetail);
            }

            $response = new UserResponse();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validationCreateRequest(UserRequest $request): void
    {
        if (preg_match('/[^a-zA-Z| ]/i', $request->fullName) || $request->fullName == '') {
            throw new ValidationException('Invalid characters');
        }
    }

    public function requestUpdateUserDetail(UserRequest $request): UserResponse
    {
        $this->validationUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userDetailRepository->findByUsername($request->username);
            if ($user == null) {
                throw new ValidationException('Update failed');
            } else {
                $userDetail = new  UserDetail();
                $userDetail->setUsername($request->username);
                $userDetail->setFullName(ucwords(strtolower(trim($request->fullName))));
                $userDetail->setRoleId($request->roleId);
                $this->userDetailRepository->update($userDetail);
            }
            $response = new UserResponse();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    private function validationUpdateRequest(UserRequest $request): void
    {
        if (preg_match('/[^a-zA-Z| ]/i', $request->fullName) || ($request->fullName == '')) {
            throw new ValidationException('Invalid characters');
        }
    }
}