<?php include('view/header.php'); ?>

<section id="list" class="list">

    <header class="list__row list__header">

        <h1>Todo List</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">

            <input type="hidden" name="action" value="list_items">
            <select name="item_id" required>
            
                <option value="0">View All</option>
                <?php foreach ($action as $action) : ?>
                <?php if ($item_id == $category['categoryID']) { ?>
                    <option value="<?= $item['Description'] ?>" selected>
                <?php } else { ?>
                    <option value="<?= $item['Description'] ?>">
                <?php } ?>
                        <?= $item['Title'] ?>
                    </option>
                    <?php endforeach; ?>

            </select>
            <button class="add-button bold">Go</button>

        </form>

    </header>
    <?php if($categories) { ?>
        <?php foreach ($categories as $category) : ?>
        <div class ="list__row">
            <div class="list__item">
                <p class="bold"><?= $category['categoryName'] ?></p>
                <p><?= $category['categoryName'] ?></p>
            </div>
            <div class="list__removeCategory">
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="category_id" value="<?= $category['categoryID'] ?>">
                    <button class="remove-button">x</button>
                </form>
            </div>
        </div>

    <?php endforeach; ?>
    <?php } else { ?>
    <br>
    <?php if ($category_id) { ?>
        <p> No todo items exist for this category yet.</p>
    <?php> } else { ?>
        <p> No todo items exist yet.</p>
    <?php } ?>
    <br>
    <?php } ?>

</section>

<section id="add" class="add">

    <h2> Add Todo Item </h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_item">
        <div class="add__inputs">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Please select</option>
                <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['categoryID']; ?>">
                    <?= $category['categoryName']; ?>
                </option>
                <?php endforeach; ?>

            </select>
            <Label>Title:</label>
            <input type="text" name="title" maxlength="20" placeholder="Todo Item Title" required>
            <br>
            <label>Description:</label>
            <input type="text" name="description" maxlength="120" placeholder="Todo Item Description" required>
        </div>

        <div class="add__addItem">
            <button class="add-button bold"> Add</button>
        </div>

    </form>


</section>

<br>
<p><a href=".?action=list_categories">View/Edit Categories</a></p>

<?php include('view/footer.php'); ?>