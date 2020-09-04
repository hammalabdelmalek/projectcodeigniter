
<h2><?= $title ?></h2>
<br><br>
<?php foreach($cours as $cour) : ?>
    <div class="raper">
    <h3><?php echo $cour['title']; ?></h3>
    <div class="row">
        <div class="col-md-9">
            <small class="post-date">Posted on: <?php echo $cour['created_at']; ?> in <strong><?php echo $cour['filiers']; ?></strong></small><br>
        <?php echo word_limiter($cour['body'], 60); ?>
        <br><br>
        <p><a class="btn btn-default" style="border: 1px #ccc solid" href="<?php echo site_url('/posts/'.$cour['slug']); ?>">Read More</a></p>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="pagination-links">
        <?php echo $this->pagination->create_links(); ?>
</div>