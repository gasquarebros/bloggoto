<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
$notification = notification();
$load_message = message();
$loadallUser = loadallUser();
$notify_logo = skin_url('images/db-logo2.png');
?>
<ul class="user-msg-list">
<li class="dropdown top-nav__notifications show">
    <a data-toggle="dropdown" aria-expanded="true"  href="javascript:;" id="tour_second"><i class="fa fa-envelope-o" aria-hidden="true"></i><?=(!empty($load_message))?'<span class="badge notification_circle">'.count($load_message).'</span>':''?></a>
       <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
            <div class="listview listview--hover top_message">
                <div class="listview__header">
                <?=sprintf(get_label('m_message_count'), count($load_message))?>
                </div>

                <div class="mCustomScrollbar light listview__scroll" data-mcs-theme="minimal-dark">
                    <ul>
                        <?php
                        if(!empty($load_message)) {
                            foreach ($load_message as $mkey => $mval) {
                               ?>
                                <a href="<?=base_url('conversations/view/'.base64_encode($mval['notification_id']))?>" class="listview__item">
                                    <img src="<?=$notify_logo?>" class="listview__img circle-sm notification_text" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading"><?=(!empty($loadallUser[$mval['assigned_from']]))?$loadallUser[$mval['assigned_from']]['name']:''?></div>
                                        <p><?=$mval['subject']?></p>
                                    </div>
                                </a>
                               <?php
                            }
                        }
                        else {
                            ?>
                            <div class="pad-all bord-top">
                                <a class="btn-link text-dark box-block left_spacing" style="position:relative;" href="<?=base_url('conversations')?>">
                                    <i class="fa fa-angle-right fa-lg pull-right mess_icon"></i>
                                    <?=get_label('m_show_conversations')?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </li>

<li class="dropdown top-nav__notifications show">
    <a data-toggle="dropdown" class="top-nav__notify" aria-expanded="true" href="javascript:;">
        <i class="fa fa-bell-o" aria-hidden="true"></i><?=(!empty($notification))?
    '<span class="badge notification_circle">'.count($notification).'</span>':''?></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
            <div class="listview listview--hover top_message">
                <div class="listview__header">
                <?=sprintf(get_label('m_notify_count'), count($notification))?>
                </div>

                <div class="mCustomScrollbar light listview__scroll" data-mcs-theme="minimal-dark">
                    <ul>
                        <?php
                        if(!empty($notification)) {
                            foreach ($notification as $nkey => $nval) {
                               ?>
                                <a href="<?=base_url('conversations/view/'.base64_encode($nval['notification_id']))?>" class="listview__item">
                                    <img src="<?=$notify_logo?>" class="listview__img circle-sm notification_text" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading"><?=(!empty($loadallUser[$nval['assigned_from']]))?$loadallUser[$nval['assigned_from']]['name']:''?></div>
                                        <p><?=$nval['subject']?></p>
                                    </div>
                                </a>
                               <?php
                            }
                        }
                        else {
                            ?>
                             <div class="pad-all bord-top">
                                <a class="btn-link text-dark box-block left_spacing" style="position:relative;" href="<?=base_url('conversations')?>">
                                    <i class="fa fa-angle-right fa-lg pull-right mess_icon"></i>
                                    <?=get_label('m_show_conversations')?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </li>
</ul>
