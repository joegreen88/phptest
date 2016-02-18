<?php

/**
 * Class ArticlesRepositoryTest
 */
class ArticlesRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \FizzBuzz\Service\ArticlesRepository
     */
    private $articleService;

    public function __construct()
    {
        $this->articleService = new \FizzBuzz\Service\ArticlesRepository();
    }

    // slug, expected result
    public function slugProvider()
    {
        return [
            ['random-test-one', false],
            [null, true],
            [false, false],
            [0000, false],
            [true, false]
        ];
    }

    /**
     * @dataProvider slugProvider
     */
    public function testArticleExists($slug, $expected)
    {
        $articleArray = $this->getArticle();

        $slug = $articleArray['slug'];
        $id = $articleArray['id'];
        $outcome = $this->articleService->articleExist($id, $slug);

        $this->assertInternalType('array', $articleArray);
        $this->assertTrue($outcome === $expected);
    }

    private function getArticle()
    {
        return $this->articleService->findAll()[0];
    }
}
