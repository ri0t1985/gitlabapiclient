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

class Snippets extends AbstractApi
{
    /**
     * @return mixed
     */
    public function all(int|string $project_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets'));
    }

    /**
     * @return mixed
     */
    public function show(int|string $project_id, int $snippet_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id)));
    }

    /**
     * @return mixed
     */
    public function create(int|string $project_id, string $title, string $filename, string $code, string $visibility)
    {
        return $this->post($this->getProjectPath($project_id, 'snippets'), [
            'title' => $title,
            'file_name' => $filename,
            'code' => $code,
            'visibility' => $visibility,
        ]);
    }

    /**
     * @return mixed
     */
    public function update(int|string $project_id, int $snippet_id, array $params)
    {
        return $this->put($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id)), $params);
    }

    /**
     * @return mixed
     */
    public function content(int|string $project_id, int $snippet_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/raw'));
    }

    /**
     * @return mixed
     */
    public function remove(int|string $project_id, int $snippet_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id)));
    }

    /**
     * @return mixed
     */
    public function showNotes(int|string $project_id, int $snippet_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/notes'));
    }

    /**
     * @return mixed
     */
    public function showNote(int|string $project_id, int $snippet_id, int $note_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/notes/'.self::encodePath($note_id)));
    }

    /**
     * @return mixed
     */
    public function addNote(int|string $project_id, int $snippet_id, string $body, array $params = [])
    {
        $params['body'] = $body;

        return $this->post($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/notes'), $params);
    }

    /**
     * @return mixed
     */
    public function updateNote(int|string $project_id, int $snippet_id, int $note_id, string $body)
    {
        return $this->put($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/notes/'.self::encodePath($note_id)), [
            'body' => $body,
        ]);
    }

    /**
     * @return mixed
     */
    public function removeNote(int|string $project_id, int $snippet_id, int $note_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/notes/'.self::encodePath($note_id)));
    }

    /**
     * @return mixed
     */
    public function awardEmoji(int|string $project_id, int $snippet_id)
    {
        return $this->get($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/award_emoji'));
    }

    /**
     * @return mixed
     */
    public function removeAwardEmoji(int|string $project_id, int $snippet_id, int $award_id)
    {
        return $this->delete($this->getProjectPath($project_id, 'snippets/'.self::encodePath($snippet_id).'/award_emoji/'.self::encodePath($award_id)));
    }
}
