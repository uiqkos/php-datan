<?php


class LikeRepository extends Repository {
    public function isLikes(int $user_id): bool | Like {
        $likes = $this->findAll();
        foreach ($likes as $like) {
            if ($like->user_id == $user_id)
                return $like;
        }
        return false;
    }
}