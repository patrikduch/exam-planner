<?php

namespace  App\Infrastructure\Repositories;

use App\Core\Interfaces\Repositories\ILecturerRepository;
use Nette;

/**
 * Class LecturerRepository
 * @package App\Infrastructure\Repositories
 */
class LecturerRepository implements ILecturerRepository {

    /**
     * @var Nette\Database\Context  $database  Instance of Nette database.
     */
    private $database;

    /**
     * LecturerRepository constructor.
     * @param Nette\Database\Context $database
     */
    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /**
     * Fetch single lecturer entity by numeric identifier.
     * @param int $id
     */
    public function getLecturer(int $id)
    {
        $resultSet = $this->database->fetch('CALL get_lecturer(?)', $id);
        return $resultSet;
    }

    /**
     * Fetch lecturer courses by lecturer code that identifies particular lecturer.
     * @param string $lecturerCode Code lecturer identifier.
     */
    public function getLecturerCourses(string $lecturerCode)
    {
        $resultSet = $this->database->fetchAll('CALL get_lecturer_courses(?)', $lecturerCode);
        return $resultSet;
    }

    /**
     * Fetch all pre degrees for the selected lecturer.
     * @param string $lecturerCode
     * @return Nette\Database\ResultSet
     */
    public function getLecturerPreDegrees(string $lecturerCode)
    {
        $preDegreesSet = $this->database->fetchAll("CALL pr_get_lecturer_pre_degrees(?)", $lecturerCode);
        return $preDegreesSet;
    }

    /**
     * Fetch all post degrees fro the selected lecturer.
     * @param string $lecturerCode
     * @return Nette\Database\ResultSet
     */
    public function getLecturerPostDegrees(string $lecturerCode)
    {
        $postDegreesSet = $this->database->fetchAll('CALL pr_get_lecturer_post_degrees(?)', $lecturerCode);
        return $postDegreesSet;
    }

    /**
     * Fetch all active exams for the selected lecturer.
     * @param string $lecturerCode
     */
    public function getActiveExams(string $lecturerCode)
    {
        $activeExams = $this->database->fetchAll('CALL pr_get_active_exams(?)', $lecturerCode);
        return $activeExams;
    }

    /**
     * Fetch scheduled (ended) exams for the selected lecturer.
     * @param string $lecturerCode
     */
    public function getScheduledExams(string $lecturerCode)
    {
        $scheduledExams = $this->database->fetchAll('CALL pr_get_finished_exams(?)', $lecturerCode);
        return $scheduledExams;
    }
}