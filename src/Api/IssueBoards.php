<?php

declare(strict_types=1);

/*
 * This file is part of the Gitlab API library.
 *
 * (c) Matt Humphrey <matth@windsor-telecom.co.uk>
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitlab\Api;

class IssueBoards extends AbstractApi
{
    /**
     * @return mixed
     */
    public function all(int|string|null $project_id = null, array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();

        $path = null === $project_id ? 'boards' : $this->getProjectPath($project_id, 'boards');

        return $this->get($path, $resolver->resolve($parameters));
    }

    /**
     * @return mixed
     */
    public function show(int|string $project_id, int $board_id)
    {
        return $this->get($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id)));
    }

    /**
     * @return mixed
     */
    public function create(int|string $project_id, array $params)
    {
        return $this->post($this->getProjectPath($project_id, 'boards'), $params);
    }

    /**
     * @return mixed
     */
    public function update(int|string $project_id, int $board_id, array $params)
    {
        return $this->put($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id)), $params);
    }

    /**
     * @return mixed
     */
    public function remove(int|string $project_id, int $board_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id)));
    }

    /**
     * @return mixed
     */
    public function allLists(int|string $project_id, int $board_id)
    {
        return $this->get($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id).'/lists'));
    }

    /**
     * @return mixed
     */
    public function showList(int|string $project_id, int $board_id, int $list_id)
    {
        return $this->get($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id).'/lists/'.self::encodePath($list_id)));
    }

    /**
     * @return mixed
     */
    public function createList(int|string $project_id, int $board_id, int $label_id)
    {
        $params = [
            'label_id' => $label_id,
        ];

        return $this->post($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id).'/lists'), $params);
    }

    /**
     * @return mixed
     */
    public function updateList(int|string $project_id, int $board_id, int $list_id, int $position)
    {
        $params = [
            'position' => $position,
        ];

        return $this->put($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id).'/lists/'.self::encodePath($list_id)), $params);
    }

    /**
     * @return mixed
     */
    public function deleteList(int|string $project_id, int $board_id, int $list_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'boards/'.self::encodePath($board_id).'/lists/'.self::encodePath($list_id)));
    }
}
