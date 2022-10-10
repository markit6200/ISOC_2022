<?php 
$pager->setSurroundCount(2);
?>
 <!-- <div class="btn-group pagination justify-content-start" role="group" aria-label="pager counts">
        &nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-light"><?= 'Page '.$currentPage.' of '.$totalPages; ?></button>
    </div> -->
<ul class="pagination pagination-sm m-0 justify-content-end">
	<?php if ($pager->hasPreviousPage()) : ?>
		<li class="page-item">
			<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="หน้าแรก">
				<span aria-hidden="true">หน้าแรก</span>
			</a>
		</li>
		<li class="page-item">
			<a href="<?= $pager->getPrevious() ?>" class="page-link" aria-label="<?= lang('Pager.previous') ?>">
				<span>«</span>
			</a>
		</li>
	<?php endif ?>

	<?php foreach ($pager->links() as $link) : ?>
		<li <?= $link['active'] ? 'class="active page-item"' : 'class="page-item"' ?>>
			<a href="<?= $link['uri'] ?>" class="page-link">
				<?= $link['title'] ?>
			</a>
		</li>
	<?php endforeach ?>

	<?php if ($pager->hasNextPage()) : ?>
		<li class="page-item">
			<a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
				<span aria-hidden="true">»</span>
			</a>
		</li>
		<li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true">หน้าสุดท้าย</span>
                </a>
	<?php endif ?>
</ul>