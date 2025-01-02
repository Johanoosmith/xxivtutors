<!-- resources/views/frontend/category.php -->

<div>
    <h1><?php echo htmlspecialchars($category->title); ?></h1>
    <p><?php echo htmlspecialchars($category->description); ?></p>

    <ul>
        <?php foreach ($items as $item): ?>
            <li><?php echo htmlspecialchars($item->name); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
