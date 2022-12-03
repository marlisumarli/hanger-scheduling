<?php

namespace Subjig\Report\Service;

use Exception;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\ResponseSubjigApp;
use Subjig\Report\Model\UserDetail;
use Subjig\Report\Exception\ValidationException;
use Subjig\Report\HTTP\Request\UserRequest;
use Subjig\Report\Repository\UserDetailRepository;

class UserDetailService
{
    private UserDetailRepository $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
    }

    public function requestCreateUserDetail(UserRequest $request): ResponseSubjigApp
    {
        $this->validationCreateRequest($request);
        try {
            Database::beginTransaction();

            $user = $this->userDetailRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException('User ada');
            } else {
                $userDetail = new  UserDetail();
                $userDetail->setId(uniqid());
                $userDetail->setUsername($request->username);
                $userDetail->setFullName(ucwords(strtolower(trim($request->fullName))));
                $userDetail->setRoleId($request->roleId);
                $this->userDetailRepository->save($userDetail);
            }

            $response = new ResponseSubjigApp();
            $response->userDetail = $userDetail;

            Database::commitTransaction();
            return $response;

        } catch (Exception $exception) {
            Database::rollBackTransaction();
            throw $exception;
        }
    }

    public function requestUpdateUserDetail(UserRequest $request): ResponseSubjigApp
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
            $response = new ResponseSubjigApp();
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

    private function validationUpdateRequest(UserRequest $request): void
    {
        if (preg_match('/[^a-zA-Z| ]/i', $request->fullName) || ($request->fullName == '')) {
            throw new ValidationException('Invalid characters');
        }
    }
}