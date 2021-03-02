<?php
    require('model/database.php');
    require('model/itemdb.php');

    $item_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $category_name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if (!$category_id) {
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_items'; // was list_assignments
        }
    }

    switch($action) {
        case "list_categories"; //was list_courses
            $categories = get_categories();
            include('view/category_list.php');
            break;
        case "add_category": //was add_course
                add_category($category_name);
                header("Location: .?action=list_categories");
            break;
        case "add_item";
            if ($category_id && $title && $description) {
                add_item($category_id, $title, $description);
                header("Location: .?course_id=$category_id");
                
            } else {
                $error = "Invalid assignment data. Check all fields and try again.";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_category";
            if($category_id) {
                try {
                    delete_category($category_id);

                } catch (PDOException $e) {
                    $error = "You cannot delete a category if to do items exist within it.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_categories");
            }
            break;

        case "delete_item":
            if($item_id) {
                delete_item($category_id);
                header("Location: .?course_id=$category_id");

            } else {
                $error = "Missing or incorrect item id.";
                include('view/error.php');
            }
            break;
        default:
             $category_name = get_category_name($category_id);
             $categories = get_categories();
           //  $items = get_items_by_category($category_id);
            include('view/item_list.php');
    }
?>