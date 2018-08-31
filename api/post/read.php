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

//Blog post query
$result = $post->read();

//Get row count

$num = $result->rowCount();

//Check if any posts
if($num > 0 ){
    // Post array

    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSCO)){
        $extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // Push to Data

        array_push($posts_arr['data'], $post_item);
    }

    //Json output

    echo json_encode($post_arr);
} else {
    //No posts
    echo json_encode(
        array('message' => ' No records')
    );
}



?>