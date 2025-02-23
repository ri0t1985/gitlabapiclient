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

class Milestones extends AbstractApi
{
    /**
     * @var string
     */
    public const STATE_ACTIVE = 'active';

    /**
     * @var string
     */
    public const STATE_CLOSED = 'closed';

    /**
     * @param int|string $project_id
     * @param array      $parameters {
     *
     *     @var int[]  $iids   return only the milestones having the given iids
     *     @var string $state  return only active or closed milestones
     *     @var string $search Return only milestones with a title or description matching the provided string.
     * }
     *
     * @return mixed
     */
    public function all(int|string $project_id, array $parameters = [])
    {
        $resolver = $this->createOptionsResolver();
        $resolver->setDefined('iids')
            ->setAllowedTypes('iids', 'array')
            ->setAllowedValues('iids', function (array $value) {
                return \count($value) === \count(\array_filter($value, 'is_int'));
            })
        ;
        $resolver->setDefined('state')
            ->setAllowedValues('state', [self::STATE_ACTIVE, self::STATE_CLOSED])
        ;
        $resolver->setDefined('search');

        return $this->get($this->getProjectPath($project_id, 'milestones'), $resolver->resolve($parameters));
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function show(int|string $project_id, int $milestone_id)
    {
        return $this->get($this->getProjectPath($project_id, 'milestones/'.self::encodePath($milestone_id)));
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function create(int|string $project_id, array $params)
    {
        return $this->post($this->getProjectPath($project_id, 'milestones'), $params);
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function update(int|string $project_id, int $milestone_id, array $params)
    {
        return $this->put($this->getProjectPath($project_id, 'milestones/'.self::encodePath($milestone_id)), $params);
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function remove(int|string $project_id, int $milestone_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'milestones/'.self::encodePath($milestone_id)));
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function issues(int|string $project_id, int $milestone_id)
    {
        return $this->get($this->getProjectPath($project_id, 'milestones/'.self::encodePath($milestone_id).'/issues'));
    }

    /**
     * @param int|string $project_id
     *
     * @return mixed
     */
    public function mergeRequests(int|string $project_id, int $milestone_id)
    {
        return $this->get($this->getProjectPath($project_id, 'milestones/'.self::encodePath($milestone_id).'/merge_requests'));
    }
}
