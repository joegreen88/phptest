<?php

namespace FizzBuzz\Service;

use Smrtr\MysqlVersionControl\DbConfig;

class SectionsRepository implements RepositoryInterface
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var string[] Fields that we are allowed to search on in findAll()
     */
    protected static $searchParams = [];

    public function __construct()
    {
        $this->db = DbConfig::getPDO(APP_ENV);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function findAll(array $params = [])
    {
        $sql = "SELECT * FROM sections";

        $sqlWheres = [];
        foreach ($params as $key => $val) {
            if (in_array($key, static::$searchParams)) {
                $sqlWheres[$key] = "`$key` = :$key";
            } else {
                unset($params[$key]);
            }
        }
        if (count($sqlWheres)) {
            $sql .= " WHERE " . implode(' AND ', $sqlWheres);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM sections WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findBySlug($slug)
    {
        $sql = "SELECT * FROM sections WHERE slug = :slug";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['slug' => $slug]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
