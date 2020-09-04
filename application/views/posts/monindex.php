<h2><?= $title ?></h2>
<br><br>
<?php foreach($cours as $cour) : ?>

<div class="raper">

    <h3><?php echo $cour['title']; ?></h3>

    <div class="row">

        <div class="col-md-9">

            <small class="post-date">Posted on: <?php echo $cour['created_at']; ?> in <strong><?php echo $cour['filiers']; ?></strong></small><br>

            <div class="raper"> 

            <?php echo word_limiter($cour['body'], 60); ?>

            </div>

            <div class="btn-group" role="group" aria-label="Basic example">

                <a href="<?php echo site_url('/posts/exoindex/'.$cour['slug']); ?>"><button class="btn btn-success">liste d'exercice</button></a>

                <?php if($this->session->userdata('role')==1): ?>
                    <a href="<?php echo base_url(); ?>posts/nbrligne/<?php echo $cour['id']; ?>"><button class="btn btn-danger"> Ajouter exo</button></a>
                <?php endif; ?>

                <?php if($this->session->userdata('role')==1): ?>
                    <a href="<?php echo base_url(); ?>posts/cours_statistics/<?php echo $cour['id']; ?>"><button class="btn btn-info">statics du cours</button></a>
                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

<div class="pagination-links">
        <?php echo $this->pagination->create_links(); ?>
</div>