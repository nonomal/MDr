<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main">
    <?php if (!empty($this->options->Breadcrumbs) && in_array('Postshow', $this->options->Breadcrumbs)) : ?>
        <div class="mdui-card breadcrumbs">
            <span class="mdui-chip-icon"><i class="mdui-icon material-icons">chevron_right</i></span>
            <span class="mdui-chip-title">
                <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo; <?php $this->category(); ?> &raquo; <?php if (!empty($this->options->Breadcrumbs) && in_array('Text', $this->options->Breadcrumbs)) : ?>正文<?php else : $this->title();
                                                                                                                                                                                                                    endif; ?>
            </span>
        </div>
    <?php endif; ?>
    <div id="post" class="mdui-card<?php if ($this->options->PjaxOption && $this->hidden) : ?> protected<?php endif; ?>" style="margin-top:20px;">
        <?php if ($this->options->mdrPostThumb) : ?>
            <div class="mdui-card-media">
                <?php echo postThumb($this); ?>
            </div>
        <?php endif; ?>
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title"><?php $this->title() ?></div>
            <div class="mdui-card-primary-subtitle">
                <?php $this->date(); ?>
                | <?php $this->category(','); ?>
                | <?php $this->commentsNum('暂无评论', '%d 条评论'); ?>
                | <?php Postviews($this); ?>
                <?php if ($this->options->WordCount) : ?>
                    | <?php WordCount($this->cid); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="mdui-card-content mdui-typo" style="padding: 0px 16px 16px 16px;">
            <?php /* MDr Time Notice */
            if ($this->options->TimeNotice) :
                if ((time() - $this->modified) >= ($this->options->TimeNoticeLock) * 24 * 60 * 60) : ?>
                    <script defer>
                        <?php if (!MDR_PJAX) echo "window.onload = () => {"; ?>
                        mdui.snackbar({
                            message: '此文章最后修订于 <?= date('Y年m月d日', $this->modified) ?>，其中的信息可能已经有所发展或是发生改变。',
                            position: '<?= $this->options->mdrSnackbar ?>',
                            timeout: 5000
                        });
                        <?php if (!MDR_PJAX) echo "}"; ?>
                    </script>
            <?php endif;
            endif; ?>
            <?php $this->content(); ?>
            <?php license($this->fields->linceses); ?>
            <script defer>
                <?php if (!MDR_PJAX) echo "window.onload = () => {"; ?>
                mdrCatalog(<?= json_encode(getCatalog($this->content)) ?>)
                <?php if (!MDR_PJAX) echo "}"; ?>
            </script>
        </div>
    </div>
    <div class="tags"><?php mdrTags($this); ?></div>
    <?php $this->need('comments.php'); ?>
    <div class="mdui-row footer-nav">
        <div class="mdui-ripple mdui-col-xs-6 mdui-col-sm-6 footer-nav-left">
            <div class="footer-nav-inner">
                <i class="mdui-icon material-icons footer-nav-icon">arrow_back</i>
                <span class="footer-nav-title">上一篇</span>
                <div class="footer-nav-text"><?php $this->thePrev('%s', '没有了'); ?></div>
            </div>
        </div>
        <div class="mdui-ripple mdui-col-xs-6 mdui-col-sm-6 footer-nav-right">
            <div class="footer-nav-inner">
                <i class="mdui-icon material-icons footer-nav-icon">arrow_forward</i>
                <span class="footer-nav-title">下一篇</span>
                <div class="footer-nav-text"><?php $this->theNext('%s', '没有了'); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>