CREATE TABLE IF NOT EXISTS `scores` (
  `filename_id` varchar(255) NOT NULL PRIMARY KEY,
  `person_name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `last_run_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (`filename_id`)
)
