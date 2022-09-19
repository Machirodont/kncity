<?php

namespace kncity\controllers;

use kncity\app\Request;
use kncity\repo\StudentRepository;

class UsersController extends BaseController
{
    public const MAX_PAGE_SIZE = 6;
    public const DEFAULT_PAGE_SIZE = 5;

    /**
     * @var StudentRepository
     */
    private $studentRepo;

    public function __construct()
    {
        parent::__construct();
        $this->studentRepo = new StudentRepository($this->db);
    }

    public function get(Request $request): array
    {
        if (!$this->user) {
            return ["err" => "not authorized"];
        }
        $pageFrom = (int)$request->get("from") ?? 0;
        $pageSize = (int)$request->get("pageSize") ?? self::DEFAULT_PAGE_SIZE;
        if ($pageSize > self::MAX_PAGE_SIZE) {
            $pageSize = self::MAX_PAGE_SIZE;
        }

        return [
            "students" => $this->studentRepo->getList($pageFrom, $pageSize),
            "studentsCount" => $this->studentRepo->getCount()
        ];
    }

}