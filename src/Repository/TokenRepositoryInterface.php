<?php
/**
 * TokenRepositoryInterface
 */

namespace Bmatovu\MtnMomo\Repository;

/**
 * Interface TokenRepositoryInterface
 *
 * @package Bmatovu\MtnMomo\Repository
 */
interface TokenRepositoryInterface
{
    /**
     * Create token.
     *
     * @param array $attributes
     *
     * @return \Bmatovu\MtnMomo\Model\TokenInterface Token created.
     */
    public function create(array $attributes);

    /**
     * Retrieve token.
     *
     * @param string $access_token
     *
     * @return \Bmatovu\MtnMomo\Model\TokenInterface|null Token, null if non found..
     */
    public function retrieve($access_token = null);

    /**
     * Destory token.
     *
     * return void
     */
    public function delete($access_token);

    /**
     * Updates token.
     *
     * \Bmatovu\MtnMomo\Model\TokenInterface|null
     */
    public function update($access_token, array $attributes);
}
