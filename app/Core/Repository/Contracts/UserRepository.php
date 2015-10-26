<?php

namespace FELS\Core\Repository\Contracts;

interface UserRepository
{
    /**
     * Find a user by slug with eager loaded relationships.
     *
     * @param $slug
     * @return mixed
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugWithRelations($slug);

    /**
     * Fetch paginated list of disabled users.
     *
     * @param $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function disabled($limit);

    /**
     * Add new user by administrator.
     *
     * @param array $data
     * @return mixed
     */
    public function adminCreate(array $data);

    /**
     * Finding a user or creating a new user if the user does not exist.
     *
     * @param array $userData
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrCreate(array $userData);

    /**
     * Find a user by activation code.
     *
     * @param $code
     * @param bool|false $confirmed
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findByActivationCode($code, $confirmed = false);

    /**
     * Follow a user.
     *
     * @param $followedId
     * @param $user
     * @return mixed
     */
    public function createRelationship($followedId, $user);

    /**
     * Unfollow a user.
     *
     * @param $followedId
     * @param $user
     * @return mixed
     */
    public function destroyRelationship($followedId, $user);

    /**
     * Get activity feed for a user.
     *
     * @param $user
     * @return mixed
     */
    public function getActivityFeedFor($user);

    /**
     * Finding a user or creating a new user if the user does not exist.
     * Use for open authentication.
     *
     * @param array $userData
     * @param $authProvider
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function oauthCreate(array $userData, $authProvider);
}
