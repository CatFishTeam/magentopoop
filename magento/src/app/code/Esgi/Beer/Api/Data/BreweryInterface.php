<?php

declare(strict_types=1);

namespace Esgi\Beer\Api\Data;

/**
 * Esgi brewery interface.
 * @api
 */
interface BreweryInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID      = 'entity_id';
    const TITLE    = 'title';
    const CONTENT = 'content';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set ID
     *
     * @param int $id
     * @return BreweryInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $title
     * @return BreweryInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return BreweryInterface
     */
    public function setContent($content);
}
