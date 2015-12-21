<?php

namespace Markup;
require 'Database.php';

class HtmlReader {

    private $DB;

    public function __construct() {
        $this->DB = new Database();
    }

    public function score_html($path) {
        /*
        REQUIREMENT #1: Accept HTML Content Input
        REQUIREMENT #2: Accept unique id for HTML Content to score (filename prefix) - THIS IS DONE IN THE DATABASE CLASS->insert_score METHOD
        REQUIREMENT #3: Score HTML content using the scoring guide
        REQUIREMENT #4: Save results to a MySQL database
        */

        $doc = new \DOMDocument();
        @$doc->loadHTMLFile($path);
        $rules = $this->DB->get_rules();
        $score = 0;
        foreach ($rules as $rule) {
            $result = $doc->getElementsByTagName($rule->tag_name);
            $instances = $result->length;
            for ($i = 0; $i < $instances; $i++) {
                $score += (int)$rule->points;
            }
        }

        $filename = basename($path);

        if (!empty($this->DB->get_scores_by_id($filename))) {
            $this->DB->update_score($filename, $score);
        } else {
            $this->DB->insert_score($score, $filename);
        }
    }


    public function scores_by_person($person_name) {
        // REQUIREMENT #5: Retrieve scores for a unique id
        return $this->DB->get_scores_by_person($person_name);
    }

    public function scores_by_date_range($from, $to) {
        // REQUIREMENT #6: Retrieve all scores run in the system for a custom date range
        return $this->DB->get_scores_by_date_range($from, $to);
    }

    public function highest_score_by_person($person_name) {
        // REQUIREMENT #7: Retrieve highest scored unique id
        return $this->DB->get_max_score_by_person($person_name);
    }

    public function lowest_score_by_person($person_name) {
        // REQUIREMENT #8: Retrieve lowest scored unique id
        return $this->DB->get_min_score_by_person($person_name);
    }

    public function average_score() {
        // REQUIREMENT #9: write one query that will find the average score for all runs
        return $this->DB->get_average_score();
    }
}
