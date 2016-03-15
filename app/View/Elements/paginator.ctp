<?php if ($this->params['paging'][$model]['pageCount'] > 1) { ?>
<div class="row">
    <div class="col-md-12">
        <ul class="pagination">
        <?php
            echo $this->Paginator->first('<<', array('tag' => 'li', 'title' => '最初へ'), '<<', array('tag' => 'li', 'class' => 'disabled'));
            echo $this->Paginator->numbers(array(
                'before' => $this->Paginator->hasPrev() ? $this->Paginator->prev('<', array('tag' => 'li', 'title' => '前へ')) : '',
                'after' => $this->Paginator->hasNext() ? $this->Paginator->next('>', array('tag' => 'li', 'title' => '次へ')) : '',
                // 'modulus' => 4,
                'tag' => 'li',
                'separator' => '',
                'currentClass' => 'active',
                'currentTag' => 'a'
            ));
            echo $this->Paginator->last('>>', array('tag' => 'li', 'title' => '最後へ'), '>>', array('tag' => 'li', 'class' => 'disabled'));
        ?>
        </ul>
    </div>
</div>
<?php } ?>