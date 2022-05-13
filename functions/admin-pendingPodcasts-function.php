<?php
include '../includes/autoload-class.php';
$admin = new Admin();

if (isset($_POST['accept-podcasts'])) {

    $podcast_id = $_POST['podcast_id'];
  
    if (!$podcast_id) return;

    $admin->updatePodcastStatus($podcast_id, 'accepted');
}

if (isset($_POST['decline-podcasts'])) {
    $podcast_id = $_POST['podcast_id'];

    if (!$podcast_id) return;
    $admin->updatePodcastStatus($podcast_id, 'decline');
}
