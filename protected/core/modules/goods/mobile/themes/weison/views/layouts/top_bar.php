<header class="mui-bar mui-bar-nav">
    <a class="mui-icon mui-icon-left-nav mui-pull-left" href="/"></a>
    <h1 class="mui-title">
        <?= isset($this->context->actionTitlesMap[$this->context->action->id]) ?
            $this->context->actionTitlesMap[$this->context->action->id] : '';
        ?>
    </h1>
</header>