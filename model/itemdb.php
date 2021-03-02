<?php
     function get_categories() {
        global $db; //connects to database
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function get_category_name($category_id) {
        if (!$category_id) {
            return "All Categories";
        }
        global $db; //connects to database
        $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        $course_name = $category['categoryName'];
        return $category_name;
    }
    
    function get_items_by_category($category_id) {
        global $db;
        $query = 'SELECT * FROM todoitems
            WHERE todoitems.categoryID = :categoryid
            ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();
        return $items;
    }

    function get_item ($item_id) {
        global $db;
        $query = 'SELECT * FROM todoitems
            WHERE categoryID = :item_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $item_id);
        $statement->execute();
        $todoitem = $statement->fetch();
        $statement->closeCursor();
        return $todoitem;
    }

    function list_items ($action) {
        global $db;
        $query = 'SELECT * FROM todoitems
            WHERE categoryID = :categoryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $action = $statement->fetchAll();
        $statement->closeCursor();
        return $action;
    }

    function delete_item ($item_id) {
        global $db;
        $query = 'DELETE FROM todoitems
            WHERE category_ID = :cateogry_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_item ($category_id, $title, $description) {
        global $db;
        $query = 'INSERT INTO todoitems (categoryID, Title, Description) VALUES
                (:category_id, :title, :description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($category_name) {
        global $db; //connects to database
        $query = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':categoryName', $category_name);
        $statement->execute();
        $statement->closeCursor();
    }
?>