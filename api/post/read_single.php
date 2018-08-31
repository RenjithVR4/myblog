<?php 

//headers 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB  & connect 

$database = new Database();
$db = $database->connect();

// Instatiate blog post object

$post = new Post($db);


// Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post

$post->read_single();

//Create array

$post_arr = array(
    'id' => $post->id,
    'title' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name

);

//Json output

print_r(json_encode($post_arr));