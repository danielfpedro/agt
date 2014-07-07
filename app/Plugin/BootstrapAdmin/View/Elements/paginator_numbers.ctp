<ul class="pagination pagination-sm" style="margin: 0;">
    <?php
        echo $this->Paginator->prev("<span class='glyphicon glyphicon-chevron-left'></span>",
            array('tag' => 'li', 'escape'=> false),
            null,
            array('tag' => 'li',
                'class' => 'disabled',
                'disabledTag' => 'a',
                'escape'=> false)
            );
        echo $this->Paginator->numbers(
            array('separator' => '',
                'currentTag' => 'a',
                'currentClass' => 'active',
                'tag' => 'li',
                'first' => 1)
            );

        echo $this->Paginator->next(
            "<span class='glyphicon glyphicon-chevron-right'></span>",
            array('tag' => 'li',
                'currentClass' => 'disabled',
                'escape'=> false
                ),
            null,
            array('tag' => 'li',
                'class' => 'disabled',
                'disabledTag' => 'a',
                'escape'=> false)
            );
    ?>
</ul>	
