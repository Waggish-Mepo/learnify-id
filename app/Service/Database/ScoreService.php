<?php

namespace App\Service\Database;

class ScoreService{

    public function divideExperience ($score, $experience) {

        if ($score > 80) {
            return $experience *= 1;
        } else if($score > 60) {
            return $experience *= 0.6;
        } else {
            return $experience *= 0.2;
        }

    }

}

